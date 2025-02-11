<x-app-layout>
    <div class="py-12 m-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Back Button -->
            <div class="mb-4">
                <a href="{{ route('wallets.index') }}" class="text-gray-300 hover:text-[#FCD535] transition-colors">
                    <i class="fas fa-arrow-left"></i> &laquo; Back to Wallets
                </a>
            </div>

            <!-- Wallet Info Card -->
            <div
                class="bg-white/10 backdrop-filter backdrop-blur-lg border border-gray-700 shadow-xl sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-2xl font-bold text-white">{{ $wallet->emoji }} {{ $wallet->name }}</h2>
                        <div class="space-x-2">
                            <button onclick="openEditModal()"
                                class="bg-[#FCD535] hover:bg-[#FCD535]/80 text-gray-900 font-bold py-2 px-4 rounded-md transition-colors">
                                Edit
                            </button>
                            <form action="{{ route('wallets.destroy', $wallet) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-md transition-colors"
                                    onclick="return confirm('Are you sure you want to delete this wallet?')">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="p-4 bg-gray-800/50 rounded-lg">
                            <p class="text-gray-400">Current Balance</p>
                            <p class="text-3xl font-bold text-white">Rp{{ number_format($wallet->balance, 2) }}</p>
                        </div>
                        <div class="p-4 bg-gray-800/50 rounded-lg">
                            <p class="text-gray-400">Created On</p>
                            <p class="text-lg text-white">{{ $wallet->created_at->format('M d, Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Transaction History -->
            <div class="bg-white/10 backdrop-filter backdrop-blur-lg border border-gray-700 shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-4 text-white">Transaction History</h3>
                    @if ($wallet->transactions && $wallet->transactions->count() > 0)
                        <div class="overflow-x-auto">
                            <div class="max-h-[400px] overflow-y-auto">
                                <table class="min-w-full divide-y divide-gray-700">
                                    <thead class="bg-gray-800/50">
                                        <tr>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider sticky top-0 bg-gray-800/50">
                                                Date</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider sticky top-0 bg-gray-800/50">
                                                Description</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider sticky top-0 bg-gray-800/50">
                                                Amount</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider sticky top-0 bg-gray-800/50">
                                                Type</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-gray-800/30 divide-y divide-gray-700">
                                        @foreach ($wallet->transactions->sortByDesc('created_at')->take(10) as $transaction)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-gray-200">
                                                    {{ $transaction->created_at->format('M d, Y') }}
                                                </td>
                                                <td class="px-6 py-4 text-gray-200">{{ $transaction->description }}</td>
                                                <td class="px-6 py-4 text-gray-200">
                                                    Rp{{ number_format($transaction->amount, 2) }}</td>
                                                <td class="px-6 py-4">
                                                    <span
                                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                        {{ $transaction->type === 'income'
                                                            ? 'bg-green-900 text-green-200'
                                                            : ($transaction->type === 'expense'
                                                                ? 'bg-red-900 text-red-200'
                                                                : 'bg-yellow-900 text-yellow-200') }}">
                                                        {{ ucfirst($transaction->type) }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @else
                        <p class="text-gray-400">No transactions found for this wallet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editWalletModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-gray-800 border-gray-700">
            <div class="mt-3">
                <h2 class="text-lg font-medium text-gray-200">Edit Wallet</h2>
                <form action="{{ route('wallets.update', $wallet) }}" method="POST" class="mt-4">
                    @csrf
                    @method('PUT')

                    <!-- Preview Wallet -->
                    <div id="walletPreview"
                        class="border border-gray-700 shadow-xl rounded-lg cursor-pointer hover:bg-opacity-80 transition-all duration-200 mb-4 mx-auto"
                        style="background-color: {{ $wallet->color_hex }}; width: 200px; height: 200px;">
                        <div class="p-4 sm:p-6 flex flex-col justify-end h-full w-full">
                            <div class="text-content">
                                <p id="previewEmoji" class="text-4xl sm:text-5xl mb-2 sm:mb-4">{{ $wallet->emoji }}</p>
                                <h3 id="previewName" class="text-lg sm:text-xl font-semibold">{{ $wallet->name }}</h3>
                                <p id="previewBalance" class="text-sm sm:text-md">
                                    Rp{{ number_format($wallet->balance, 2) }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-200 text-sm font-bold mb-2" for="edit_name">
                            Wallet Name
                        </label>
                        <input type="text" name="name" id="edit_name" value="{{ $wallet->name }}" required
                            class="w-full rounded-md bg-gray-700 border-gray-600 text-gray-200 focus:border-[#FCD535] focus:ring focus:ring-[#FCD535]/50"
                            oninput="updatePreview()">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-200 text-sm font-bold mb-2" for="edit_balance">
                            Current Balance
                        </label>
                        <input type="number" step="0.01" name="balance" id="edit_balance"
                            value="{{ $wallet->balance }}" required
                            class="w-full rounded-md bg-gray-700 border-gray-600 text-gray-200 focus:border-[#FCD535] focus:ring focus:ring-[#FCD535]/50"
                            oninput="updatePreview()">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-200 text-sm font-bold mb-2" for="edit_emoji">
                            Select Emoji
                        </label>
                        <div id="emoji-picker"
                            class="grid grid-cols-6 gap-2 bg-gray-700 p-2 rounded-md overflow-y-scroll max-h-32 scrollbar-hide">
                            <!-- Emoji list will be populated here by JavaScript -->
                        </div>
                        <input type="text" name="emoji" id="edit_emoji" value="{{ $wallet->emoji }}" required
                            class="hidden" oninput="updatePreview()">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-200 text-sm font-bold mb-2" for="edit_color_hex">
                            Select Color
                        </label>
                        <input type="color" name="color_hex" id="edit_color_hex" value="{{ $wallet->color_hex }}"
                            required
                            class="w-full rounded-md bg-gray-700 border-gray-600 text-gray-200 focus:border-[#FCD535] focus:ring focus:ring-[#FCD535]/50 mt-1 h-10 cursor-pointer"
                            oninput="updatePreview()">
                    </div>
                    <div class="flex justify-end">
                        <button type="button" onclick="closeEditModal()"
                            class="mr-2 px-4 py-2 bg-gray-700 text-gray-200 rounded-md hover:bg-gray-600">
                            Cancel
                        </button>
                        <button type="submit"
                            class="px-4 py-2 bg-[#FCD535] text-gray-900 rounded-md hover:bg-[#FCD535]/80">
                            Update Wallet
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
        .scrollbar-hide {
            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: none;  /* Firefox */
        }
    </style>

    <script>
        function openEditModal() {
            document.getElementById('editWalletModal').classList.remove('hidden');
        }

        function closeEditModal() {
            document.getElementById('editWalletModal').classList.add('hidden');
        }

        document.addEventListener('DOMContentLoaded', function() {
            const emojiPicker = document.getElementById('emoji-picker');
            const emojiInput = document.getElementById('edit_emoji');

            const emojis = ["😀", "😁", "😂", "🤣", "😃", "😄", "😅", "😆", "😉", "😊", "😋", "😎", "😍", "😘",
                "🥰", "😗", "😙", "😚", "🙂", "🤗", "🤩", "🤔", "🤨", "😐", "😑", "😶", "🙄", "😏", "😣", "😥",
                "😮", "🤐", "😯", "😪", "😫", "🥱", "😴", "😌", "😛", "😜", "😝", "🤤", "😒", "😓", "😔", "😕",
                "🙃", "🤑", "😲", "☹️", "🙁", "😖", "😞", "😟", "😤", "😢", "😭", "😦", "😧", "😨", "😩", "🤯",
                "😬", "😰", "😱", "🥵", "🥶", "😳", "🤪", "😵", "😡", "😠", "🤬", "😷", "🤒", "🤕", "🤢", "🤮",
                "🤧", "😇", "🥳", "🥺", "🤠", "🤡", "🤥", "🤫", "🤭", "🧐", "🤓", "😈", "👿", "👹", "👺", "💀",
                "👻", "👽", "👾", "🤖", "💩", "😺", "😸", "😹", "😻", "😼", "😽", "🙀", "😿", "😾"
            ];

            emojis.forEach(emoji => {
                const emojiButton = document.createElement('button');
                emojiButton.type = 'button';
                emojiButton.classList.add('text-2xl', 'p-1', 'hover:bg-gray-600', 'rounded');
                emojiButton.innerText = emoji;
                emojiButton.addEventListener('click', () => {
                    emojiInput.value = emoji;
                    updatePreview();
                });
                emojiPicker.appendChild(emojiButton);
            });

            updatePreview();
        });

        function updatePreview() {
            const name = document.getElementById('edit_name').value;
            const balance = document.getElementById('edit_balance').value;
            const emoji = document.getElementById('edit_emoji').value;
            const color = document.getElementById('edit_color_hex').value;

            document.getElementById('previewName').innerText = name || 'Wallet Name';
            document.getElementById('previewBalance').innerText = balance ? `Rp${parseFloat(balance).toFixed(2)}` :
            'Rp0.00';
            document.getElementById('previewEmoji').innerText = emoji || '🪙';
            document.getElementById('walletPreview').style.backgroundColor = color || '#FFFFFF';

            const textColor = getContrastYIQ(color || '#FFFFFF');
            document.getElementById('walletPreview').querySelector('.text-content').style.color = textColor;
        }

        function getContrastYIQ(hexcolor) {
            hexcolor = hexcolor.replace('#', '');
            const r = parseInt(hexcolor.substr(0, 2), 16);
            const g = parseInt(hexcolor.substr(2, 2), 16);
            const b = parseInt(hexcolor.substr(4, 2), 16);
            const yiq = ((r * 299) + (g * 587) + (b * 114)) / 1000;
            return (yiq >= 128) ? 'black' : 'white';
        }
    </script>
</x-app-layout>
