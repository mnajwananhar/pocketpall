<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        // Ambil semua wallet untuk dropdown dan transaksi untuk daftar
        $wallets = Auth::user()->wallets;
        $categories = Category::all();
        $transactions = Transaction::with('wallet', 'category')->latest()->get();

        return view('transactions.index', compact('wallets', 'categories', 'transactions'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'type' => 'required|in:income,expense,transfer',
            'amount' => 'required|numeric|min:0.01',
            'wallet_id' => 'required_if:type,income,expense,transfer|exists:wallets,id',
            'to_wallet_id' => 'required_if:type,transfer|exists:wallets,id|different:wallet_id',
            'category_id' => 'nullable|exists:categories,id',
            'description' => 'nullable|string|max:255',
            'tx_date' => 'required|date',
        ]);

        try {
            DB::beginTransaction();

            $transactionDate = Carbon::parse($request->tx_date)->startOfDay()->toDateString();
            $validated['user_id'] = Auth::id();
            $validated['tx_date'] = $transactionDate;

            switch ($request->type) {
                case 'income': // Tambah Saldo
                    $wallet = Wallet::findOrFail($request->wallet_id);
                    $wallet->increment('balance', $request->amount);

                    // Simpan transaksi income
                    Transaction::create([
                        'type' => 'income',
                        'amount' => $request->amount,
                        'wallet_id' => $wallet->id,
                        'category_id' => $request->category_id,
                        'description' => $request->description,
                        'tx_date' => $validated['tx_date'],
                        'user_id' => $validated['user_id'],
                    ]);
                    break;

                case 'expense': // Pengeluaran
                    $wallet = Wallet::findOrFail($request->wallet_id);

                    if ($wallet->balance < $request->amount) {
                        throw new \Exception('Saldo tidak mencukupi untuk transaksi pengeluaran.');
                    }

                    $wallet->decrement('balance', $request->amount);

                    // Simpan transaksi expense
                    Transaction::create([
                        'type' => 'expense',
                        'amount' => $request->amount,
                        'wallet_id' => $wallet->id,
                        'category_id' => $request->category_id,
                        'description' => $request->description,
                        'tx_date' => $validated['tx_date'],
                        'user_id' => $validated['user_id'],
                    ]);
                    break;

                case 'transfer': // Transfer
                    $fromWallet = Wallet::findOrFail($request->wallet_id);
                    $toWallet = Wallet::findOrFail($request->to_wallet_id);

                    if ($fromWallet->balance < $request->amount) {
                        throw new \Exception('Saldo tidak mencukupi untuk transfer.');
                    }

                    // Kurangi saldo di wallet asal
                    $fromWallet->decrement('balance', $request->amount);

                    // Tambahkan saldo di wallet tujuan
                    $toWallet->increment('balance', $request->amount);

                    // Simpan transaksi transfer (pengeluaran dari wallet asal)
                    Transaction::create([
                        'type' => 'transfer',
                        'amount' => $request->amount,
                        'wallet_id' => $fromWallet->id,
                        'category_id' => $request->category_id,
                        'description' => 'Transfer ' . $fromWallet->name . 'to ' . $toWallet->name,
                        'tx_date' => $validated['tx_date'],
                        'user_id' => $validated['user_id'],
                    ]);

                    // Simpan transaksi transfer (pemasukan ke wallet tujuan)
                    Transaction::create([
                        'type' => 'transfer',
                        'amount' => $request->amount,
                        'wallet_id' => $toWallet->id,
                        'category_id' => $request->category_id,
                        'description' => 'Transfer from ' . $fromWallet->name,
                        'tx_date' => $validated['tx_date'],
                        'user_id' => $validated['user_id'],
                    ]);
                    break;
            }

            // dd($validated);
            DB::commit();
            return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['success' => $e->getMessage()]);
        }
    }

    public function edit(Transaction $transaction)
    {
        // Menampilkan form edit transaksi
        $wallets = Wallet::all();
        $categories = Category::all();

        return view('transactions.edit', compact('transaction', 'wallets', 'categories'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        // Validasi input
        $validated = $request->validate([
            'type' => 'required|in:income,expense,transfer',
            'amount' => 'required|numeric|min:0.01',
            'wallet_id' => 'required_if:type,income,expense|exists:wallets,id',
            'category_id' => 'nullable|exists:categories,id',
            'description' => 'nullable|string|max:255',
        ]);

        try {
            DB::beginTransaction();

            // Hitung perbedaan jumlah untuk memperbarui saldo
            $difference = $request->amount - $transaction->amount;

            $wallet = Wallet::findOrFail($request->wallet_id);

            if ($request->type === 'income') {
                $wallet->increment('balance', $difference);
            } elseif ($request->type === 'expense') {
                if ($wallet->balance < $difference) {
                    throw new \Exception('Saldo tidak mencukupi untuk memperbarui transaksi.');
                }
                $wallet->decrement('balance', $difference);
            }

            $transaction->update($validated);

            DB::commit();
            return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Transaction $transaction)
    {
        try {
            DB::beginTransaction();

            $wallet = Wallet::findOrFail($transaction->wallet_id);

            // Perbarui saldo berdasarkan jenis transaksi
            if ($transaction->type === 'income') {
                $wallet->decrement('balance', $transaction->amount);
            } elseif ($transaction->type === 'expense') {
                $wallet->increment('balance', $transaction->amount);
            }

            $transaction->delete();

            DB::commit();
            return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
