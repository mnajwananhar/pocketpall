<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Wallet;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $currentMonth = now()->month;
        $currentYear = now()->year;
        $transactionsThisMonth = Transaction::with('wallet', 'category')
        ->whereMonth('tx_date', $currentMonth)
        ->whereYear('tx_date', $currentYear)
        ->latest()
        ->get();

        // Ambil data transaksi
        $transactions = Transaction::where('user_id', $userId)->get();

        // Ambil data distribusi wallet
        $wallets = Wallet::where('user_id', $userId)->get();

        // Ambil data income dan expense bulan ini
        $incomeThisMonth = Transaction::where('user_id', $userId)
            ->where('type', 'income')
            ->where('type', '!=', 'transfer')
            ->whereMonth('tx_date', Carbon::now()->month)
            ->sum('amount');

        $expenseThisMonth = Transaction::where('user_id', $userId)
            ->where('type', 'expense')
            ->where('type', '!=', 'transfer')
            ->whereMonth('tx_date', Carbon::now()->month)
            ->sum('amount');

        // Ambil data income dan expense bulan lalu
        $incomeLastMonth = Transaction::where('user_id', $userId)
            ->where('type', 'income')
            ->whereMonth('tx_date', Carbon::now()->subMonth()->month)
            ->sum('amount');

        $expenseLastMonth = Transaction::where('user_id', $userId)
            ->where('type', 'expense')
            ->whereMonth('tx_date', Carbon::now()->subMonth()->month)
            ->sum('amount');

        // Hitung persentase perubahan
        $incomeChange = $incomeLastMonth > 0 ? (($incomeThisMonth - $incomeLastMonth) / $incomeLastMonth) * 100 : 0;
        $expenseChange = $expenseLastMonth > 0 ? (($expenseThisMonth - $expenseLastMonth) / $expenseLastMonth) * 100 : 0;

        $categories = Category::where('user_id', $userId)->orWhere('is_default', true)->get();

        return view('dashboard.index', compact('transactions', 'wallets', 'categories', 'incomeThisMonth', 'expenseThisMonth', 'incomeChange', 'expenseChange', 'currentMonth', 'currentYear', 'transactionsThisMonth'));
    }
}
