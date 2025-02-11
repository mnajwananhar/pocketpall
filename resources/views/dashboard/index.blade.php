<x-app-layout>
    <div class="flex items-center justify-center min-h-screen py-12 relative m-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-white">Financial Overview</h2>
                <p class="text-gray-400">Track your finances and spending habits</p>
            </div>

            {{-- Summary Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
                {{-- Wallets Card --}}
                <div class="bg-gradient-to-br from-blue-600 to-blue-400 rounded-lg p-6 shadow-lg">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-blue-100 text-sm">Total Wallets</p>
                            <div class="flex items-baseline">
                                <p class="text-white text-2xl font-bold">{{ $wallets->count() }}</p>
                                <p class="text-blue-100 text-sm ml-2">active</p>
                            </div>
                        </div>
                        <div class="p-2 bg-blue-500/30 rounded-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 6v18h18V6H3zm0-4a2 2 0 012-2h14a2 2 0 012 2v4H3V2z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4">
                        <p class="text-blue-100 text-sm">Total Balance</p>
                        <p class="text-white text-lg font-semibold">Rp{{ number_format($wallets->sum('balance'), 2) }}
                        </p>
                    </div>
                </div>

                {{-- Income Card --}}
                <div class="bg-gradient-to-br from-emerald-600 to-emerald-400 rounded-lg p-6 shadow-lg">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-emerald-100 text-sm">Monthly Income</p>
                            <div class="flex items-baseline">
                                <p class="text-white text-2xl font-bold">Rp{{ number_format($incomeThisMonth, 2) }}</p>
                            </div>
                        </div>
                        <div class="p-2 bg-emerald-500/30 rounded-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center">
                        @if ($incomeChange >= 0)
                            <svg class="w-4 h-4 text-emerald-100" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 10l7-7m0 0l7 7m-7-7v18" />
                            </svg>
                            <span class="text-emerald-100 text-sm ml-1">{{ $incomeChange }}% from last month</span>
                        @else
                            <svg class="w-4 h-4 text-rose-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                            </svg>
                            <span class="text-rose-100 text-sm ml-1">{{ $incomeChange }}% from last month</span>
                        @endif
                    </div>
                </div>

                {{-- Expense Card --}}
                <div class="bg-gradient-to-br from-rose-600 to-rose-400 rounded-lg p-6 shadow-lg">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-rose-100 text-sm">Monthly Expenses</p>
                            <div class="flex items-baseline">
                                <p class="text-white text-2xl font-bold">Rp{{ number_format($expenseThisMonth, 2) }}</p>
                            </div>
                        </div>
                        <div class="p-2 bg-rose-500/30 rounded-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center">
                        @if ($expenseChange >= 0)
                            <svg class="w-4 h-4 text-emerald-100" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 10l7-7m0 0l7 7m-7-7v18" />
                            </svg>
                            <span class="text-emerald-100 text-sm ml-1">{{ $expenseChange }}% from last month</span>
                        @else
                            <svg class="w-4 h-4 text-rose-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                            </svg>
                            <span class="text-rose-100 text-sm ml-1">{{ $expenseChange }}% from last month</span>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Charts Section --}}
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 mb-6">
                @if ($wallets->isEmpty())
                <div class="lg:col-span-1 bg-white/10 backdrop-filter backdrop-blur-lg shadow-xl sm:rounded-lg border border-gray-700 rounded-lg shadow-lg p-6">
                    <h3 class="text-lg font-semibold text-white mb-4">Wallet Distribution</h3>
                    <div class="flex justify-center items-center h-full" height="300">
                        <p class="text-white text-center">No wallet data available</p>
                    </div>
                    </div>
                @else
                    <div class="lg:col-span-1 bg-white/10 backdrop-filter backdrop-blur-lg shadow-xl sm:rounded-lg border border-gray-700 rounded-lg shadow-lg p-6">
                        <h3 class="text-lg font-semibold text-white mb-4">Wallet Distribution</h3>
                        <canvas id="walletsChart" class="w-full" height="300"></canvas>
                    </div>
                @endif
                <div class="lg:col-span-1 bg-white/10 backdrop-filter backdrop-blur-lg shadow-xl sm:rounded-lg border border-gray-700 rounded-lg shadow-lg p-6">
                    <h3 class="text-lg font-semibold text-white mb-0">Income vs Expenses</h3>
                    <p class="text-s font-semibold text-white/50 mb-5">this month</p>
                    <canvas id="transactionsChart" class="w-full" height="300"></canvas>
                </div>
                <div class="lg:col-span-2 bg-white/10 backdrop-filter backdrop-blur-lg shadow-xl sm:rounded-lg border border-gray-700 overflow-hidden">
                    <div class="p-6 border-b border-gray-700">
                        <h3 class="text-lg font-semibold text-white">Recent Transactions</h3>
                    </div>
                    {{-- table --}}
                    <div class="overflow-x-auto" style="max-height: 300px; overflow-y: auto; scrollbar-width: none; -ms-overflow-style: none;">
                        <style>
                            .overflow-x-auto::-webkit-scrollbar {
                                display: none;
                            }
                        </style>
                        <table class="min-w-full divide-y divide-white/10">
                            <thead class="bg-[#343a44] sticky top-0">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                        Date</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                        Description</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                        Amount</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                        Type</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-700">
                                @foreach ($transactions->sortByDesc('tx_date') as $transaction)
                                    <tr class="hover:bg-gray-700/50 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                            {{-- {{ $transaction->tx_date->format('M d, Y') }} --}}
                                            {{ \Carbon\Carbon::parse($transaction->tx_date)->format('M d, Y') }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-300">
                                            {!! $transaction->description ?: '<i>No description</i>' !!}
                                        </td>
                                        <td
                                            class="px-6 py-4 text-sm font-medium
                                            {{ $transaction->type === 'income' ? 'text-emerald-400' : ($transaction->type === 'expense' ? 'text-rose-400' : 'text-yellow-400') }}">
                                            Rp{{ number_format($transaction->amount, 2) }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                {{ $transaction->type === 'income' ? 'bg-emerald-900/50 text-emerald-200' : ($transaction->type === 'expense' ? 'bg-rose-900/50 text-rose-200' : 'bg-yellow-900/50 text-yellow-200') }}">
                                                {{ ucfirst($transaction->type) }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>  
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Data for Income vs Expenses Chart
            const transactionsCtx = document.getElementById('transactionsChart').getContext('2d');
            const transactionsChart = new Chart(transactionsCtx, {
                type: 'bar',
                data: {
                    labels: ['Income', 'Expenses'],
                    datasets: [{
                        label: 'amount',
                        data: [
                            {{ $transactionsThisMonth->where('user_id', auth()->id())->where('type', 'income')->sum('amount') }},
                            {{ $transactionsThisMonth->where('user_id', auth()->id())->where('type', 'expense')->sum('amount') }}
                        ],
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(255, 99, 132, 0.2)'
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(255, 99, 132, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Data for Wallet Distribution Chart
            const walletsCtx = document.getElementById('walletsChart').getContext('2d');
            const walletData = {!! json_encode($wallets->pluck('balance')) !!};
            if (walletData.length > 0) {
                const walletsChart = new Chart(walletsCtx, {
                    type: 'pie',
                    data: {
                        labels: {!! json_encode($wallets->pluck('name')) !!},
                        datasets: [{
                            label: 'Wallet Distribution',
                            data: walletData,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(tooltipItem) {
                                        return tooltipItem.label + ': ' + tooltipItem.raw;
                                    }
                                }
                            }
                        }
                    }
                });
            }
        });
    </script>
</x-app-layout>
