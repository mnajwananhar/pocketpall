<x-app-layout>
    <div class="flex items-center justify-center min-h-screen py-12 relative m-5">
        <div class="max-w-2xl w-full sm:px-6 lg:px-8">
            <div class="bg-white/10 backdrop-filter backdrop-blur-lg shadow-xl sm:rounded-lg border border-gray-700 mx-auto">
                <div class="p-6">
                    <h1 class="text-2xl font-bold mb-6 text-center text-white">Add Transaction</h1>

                    <!-- Tabs -->
                    <div class="flex flex-wrap justify-center space-x-0 space-y-2 sm:space-x-4 sm:space-y-0 mb-6">
                        <button id="tab-income" onclick="showTab('income')"
                            class="tab-button active flex items-center px-4 py-2 rounded-lg transition-colors duration-200 hover:bg-[#FCD535]/80 bg-[#FCD535] text-gray-900 w-full sm:w-auto">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Add Balance
                        </button>
                        <button id="tab-expense" onclick="showTab('expense')"
                            class="tab-button flex items-center px-4 py-2 rounded-lg transition-colors duration-200 hover:bg-[#FCD535]/80 bg-gray-100 text-gray-700 w-full sm:w-auto">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                            </svg>
                            Expense
                        </button>
                        <button id="tab-transfer" onclick="showTab('transfer')"
                            class="tab-button flex items-center px-4 py-2 rounded-lg transition-colors duration-200 hover:bg-[#FCD535]/80 bg-gray-100 text-gray-700 w-full sm:w-auto">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                            </svg>
                            Transfer
                        </button>
                    </div>

                    <!-- Income Form -->
                    <div id="form-income" class="tab-content transform transition-all duration-300 ease-in-out">
                        <form action="{{ route('transactions.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="type" value="income">
                            <div class="mb-4">
                                <label class="block font-medium text-gray-200 mb-2">Select Wallet</label>
                                <select name="wallet_id" required
                                    class="mt-1 block w-full rounded-md bg-gray-800 border-gray-700 text-gray-200 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500/50">
                                    @foreach ($wallets as $wallet)
                                        <option value="{{ $wallet->id }}">{{ $wallet->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-4">
                                <label class="block font-medium text-gray-200 mb-2">Date</label>
                                <input type="date" name="tx_date" id="date" required
                                    class="mt-1 block w-full rounded-md bg-gray-800 border-gray-700 text-gray-200 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500/50">
                            </div>
                            <div class="mb-4">
                                <label class="block font-medium text-gray-200 mb-2">Amount</label>
                                <input type="number" name="amount" step="0.01" required placeholder="Enter amount"
                                    class="mt-1 block w-full rounded-md bg-gray-800 border-gray-700 text-gray-200 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500/50">
                            </div>
                            <div class="mb-4">
                                <label class="block font-medium text-gray-200 mb-2">Notes</label>
                                <textarea name="description" rows="3" placeholder="Enter notes"
                                    class="mt-1 block w-full rounded-md bg-gray-800 border-gray-700 text-gray-200 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500/50"></textarea>
                            </div>
                            <div class="flex justify-end">
                                <button type="submit"
                                    class="inline-flex items-center px-4 py-2 bg-[#FCD535] border border-transparent rounded-md font-semibold text-gray-900 hover:bg-[#FCD535]/80 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FCD535] transition ease-in-out duration-150">
                                    Add Transaction
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Expense Form -->
                    <div id="form-expense" class="tab-content hidden transform transition-all duration-300 ease-in-out">
                        <form action="{{ route('transactions.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="type" value="expense">
                            <div class="mb-4">
                                <label class="block font-medium text-gray-200 mb-2">Select Wallet</label>
                                <select name="wallet_id" required
                                    class="mt-1 block w-full rounded-md bg-gray-800 border-gray-700 text-gray-200 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500/50">
                                    @foreach ($wallets as $wallet)
                                        <option value="{{ $wallet->id }}">{{ $wallet->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-4">
                                <label class="block font-medium text-gray-200 mb-2">Date</label>
                                <input type="date" name="tx_date" id="expense-date" required
                                    class="mt-1 block w-full rounded-md bg-gray-800 border-gray-700 text-gray-200 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500/50">
                            </div>
                            <div class="mb-4">
                                <label class="block font-medium text-gray-200 mb-2">Amount</label>
                                <input type="number" name="amount" step="0.01" required placeholder="Enter amount"
                                    class="mt-1 block w-full rounded-md bg-gray-800 border-gray-700 text-gray-200 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500/50">
                            </div>
                            <div class="mb-4">
                                <label class="block font-medium text-gray-200 mb-2">Expense Category</label>
                                <select name="category_id" required
                                    class="mt-1 block w-full rounded-md bg-gray-800 border-gray-700 text-gray-200 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500/50">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-4">
                                <label class="block font-medium text-gray-200 mb-2">Notes</label>
                                <textarea name="description" rows="3" placeholder="Enter notes"
                                    class="mt-1 block w-full rounded-md bg-gray-800 border-gray-700 text-gray-200 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500/50"></textarea>
                            </div>
                            <div class="flex justify-end">
                                <button type="submit"
                                    class="inline-flex items-center px-4 py-2 bg-[#FCD535] border border-transparent rounded-md font-semibold text-gray-900 hover:bg-[#FCD535]/80 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FCD535] transition ease-in-out duration-150">
                                    Add Transaction
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Transfer Form -->
                    <div id="form-transfer"
                        class="tab-content hidden transform transition-all duration-300 ease-in-out">
                        <form action="{{ route('transactions.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="type" value="transfer">
                            <div class="mb-4 flex flex-col sm:flex-row sm:items-center sm:space-x-4">
                                <div class="flex-1">
                                    <label class="block font-medium text-gray-200 mb-2">From Wallet</label>
                                    <select name="wallet_id" required
                                        class="mt-1 block w-full rounded-md bg-gray-800 border-gray-700 text-gray-200 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500/50">
                                        @foreach ($wallets as $wallet)
                                            <option value="{{ $wallet->id }}">{{ $wallet->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="flex items-center justify-center my-4 sm:my-0">
                                    <svg class="w-6 h-6 text-gray-200 transform sm:rotate-0 rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <label class="block font-medium text-gray-200 mb-2">To Wallet</label>
                                    <select name="to_wallet_id" required
                                        class="mt-1 block w-full rounded-md bg-gray-800 border-gray-700 text-gray-200 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500/50">
                                        @foreach ($wallets as $wallet)
                                            <option value="{{ $wallet->id }}">{{ $wallet->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="block font-medium text-gray-200 mb-2">Date</label>
                                <input type="date" name="tx_date" id="tf-date" required
                                    class="mt-1 block w-full rounded-md bg-gray-800 border-gray-700 text-gray-200 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500/50">
                            </div>
                            <div class="mb-4">
                                <label class="block font-medium text-gray-200 mb-2">Amount</label>
                                <input type="number" name="amount" step="0.01" required placeholder="Enter amount"
                                    class="mt-1 block w-full rounded-md bg-gray-800 border-gray-700 text-gray-200 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500/50">
                            </div>
                            <div class="mb-4">
                                <label class="block font-medium text-gray-200 mb-2">Notes</label>
                                <textarea name="description" rows="3" placeholder="Enter notes"
                                    class="mt-1 block w-full rounded-md bg-gray-800 border-gray-700 text-gray-200 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500/50"></textarea>
                            </div>
                            <div class="flex justify-end">
                                <button type="submit"
                                    class="inline-flex items-center px-4 py-2 bg-[#FCD535] border border-transparent rounded-md font-semibold text-gray-900 hover:bg-[#FCD535]/80 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FCD535] transition ease-in-out duration-150">
                                    Add Transaction
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div class="absolute top-0 left-1/2 transform -translate-x-1/2 mt-4 bg-green-500 text-white p-4 rounded-lg shadow-lg notification opacity-0 transition-opacity duration-500">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="absolute top-0 left-1/2 transform -translate-x-1/2 mt-4 bg-red-500 text-white p-4 rounded-lg shadow-lg notification opacity-0 transition-opacity duration-500">
                {{ session('error') }}
            </div>
        @endif
    </div>

    <script>
        function showTab(tabId) {
            // Hide all tabs with animation
            document.querySelectorAll('.tab-content').forEach(content => {
                content.style.opacity = '0';
                content.style.transform = 'translateX(-10px)';
                setTimeout(() => {
                    content.classList.add('hidden');
                }, 300);
            });

            document.querySelectorAll('.tab-button').forEach(button => {
                button.classList.remove('bg-[#FCD535]', 'text-gray-900');
                button.classList.add('bg-gray-100', 'text-gray-700');
            });

            // Show selected tab with animation
            setTimeout(() => {
                const selectedTab = document.getElementById('form-' + tabId);
                selectedTab.classList.remove('hidden');
                // Trigger reflow
                selectedTab.offsetHeight;
                selectedTab.style.opacity = '1';
                selectedTab.style.transform = 'translateX(0)';
            }, 300);

            const activeButton = document.getElementById('tab-' + tabId);
            activeButton.classList.remove('bg-gray-100', 'text-gray-700');
            activeButton.classList.add('bg-[#FCD535]', 'text-gray-900');
        }

        // Initialize first tab
        document.addEventListener('DOMContentLoaded', () => {
            const firstTab = document.querySelector('.tab-content');
            if (firstTab) {
                firstTab.style.opacity = '1';
                firstTab.style.transform = 'translateX(0)';
            }

            ['date', 'expense-date', 'tf-date'].forEach(id => {
                const dateInput = document.getElementById(id);
                dateInput.value = new Date().toISOString().split('T')[0];
            });

            // Show notifications with animation
            document.querySelectorAll('.notification').forEach(notification => {
                notification.classList.add('opacity-100');
            });

            // Hide notifications after 3 seconds
            setTimeout(() => {
                document.querySelectorAll('.notification').forEach(notification => {
                    notification.classList.remove('opacity-100');
                    setTimeout(() => {
                        notification.remove();
                    }, 500);
                });
            }, 3000);
        });
    </script>

    <style>
        .tab-content {
            opacity: 0;
            transform: translateX(-10px);
        }

        .tab-content:not(.hidden) {
            opacity: 1;
            transform: translateX(0);
        }

        .notification.opacity-100 {
            opacity: 1;
        }
    </style>

    @if ($errors->any())
        <div class="max-w-2xl mx-auto px-4 mt-4">
            <div class="bg-red-50 border-l-4 border-red-400 p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li class="text-sm text-red-700">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endif

</x-app-layout>
