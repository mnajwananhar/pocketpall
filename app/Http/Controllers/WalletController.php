<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Support\Facades\Auth;

class WalletController extends Controller
{
    public function index()
    {
        $wallets = Auth::user()->wallets; // Ambil wallet berdasarkan user yang login
        return view('wallets.index', compact('wallets'));
    }

    public function create()
    {
        // Menampilkan form untuk membuat wallet baru
        return view('wallets.create');
    }

    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'name' => 'required|string|max:255',
            'balance' => 'required|numeric|min:0',
            'emoji' => 'required|string|max:1',
            'color_hex' => 'required',
        ]);


        Wallet::create([
            'name' => $request->name,
            'balance' => $request->balance,
            'emoji' => $request->emoji,
            'user_id' => Auth::user()->id,
            'color_hex' => $request->color_hex,
        ]);

        return redirect()->route('wallets.index')->with('success', 'Wallet added successfully!');
    }

    public function edit(Wallet $wallet)
    {
        // Menampilkan form untuk mengedit wallet
        return view('wallets.edit', compact('wallet'));
    }

    public function update(Request $request, Wallet $wallet)
    {
        // Validasi data input
        $request->validate([
            'name' => 'required|string|max:255',
            'balance' => 'required|numeric',
            'emoji' => 'required|string|max:1',
            'color_hex' => 'required|string|max:7',
        ]);

        // Update wallet
        $wallet->update($request->only('name', 'balance', 'emoji', 'color_hex'));

        return redirect()->route('wallets.index')->with('success', 'Wallet updated successfully.');
    }

    public function destroy(Wallet $wallet)
    {
        // Hapus wallet
        $wallet->delete();

        return redirect()->route('wallets.index')->with('delete', 'Wallet deleted successfully.');
    }

    public function show(Wallet $wallet)
    {
        // Load transactions relationship
        $wallet->load('transactions');

        return view('wallets.details', compact('wallet'));
    }
}
