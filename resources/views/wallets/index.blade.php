<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-4 lg:px-8">
            <!-- Add Wallet Button -->
            <div class="mb-4 flex ml-4">
                <button type="button"
                    class="bg-[#FCD535] hover:bg-[#FCD535]/80 text-gray-900 font-bold py-2 px-4 rounded-md transition-colors duration-200"
                    onclick="openModal()">
                    Add New Wallet
                </button>
            </div>

            <!-- Wallets Grid -->
            @if ($wallets->isEmpty())
                <div class="mt-10 ml-4 text-white/70 text-xl">
                    You have no wallets. Click "Add New Wallet" to create one.
                </div>
            @else
                <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 m-4">
                    @foreach ($wallets as $wallet)
                        <div onclick="window.location='{{ route('wallets.show', $wallet) }}'"
                            class="border border-gray-700 shadow-xl rounded-lg cursor-pointer hover:bg-opacity-80 transition-all duration-200"
                            style="background-color: {{ $wallet->color_hex }};" data-color="{{ $wallet->color_hex }}">
                            <div class="p-4 sm:p-6 flex flex-col justify-end h-full w-full aspect-square">
                                <div class="text-content">
                                    <p class="text-4xl sm:text-6xl mb-2 sm:mb-4">{{ $wallet->emoji }}</p>
                                    <!-- Tampilkan emoji -->
                                    <h3 class="text-lg sm:text-xl font-semibold">{{ $wallet->name }}</h3>
                                    <p class="text-sm sm:text-base">Rp{{ number_format($wallet->balance, 2) }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

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

            @if (session('delete'))
                <div class="absolute top-0 left-1/2 transform -translate-x-1/2 mt-4 bg-red-500 text-white p-4 rounded-lg shadow-lg notification opacity-0 transition-opacity duration-500">
                    {{ session('delete') }}
                </div>
            @endif

            <!-- Modal -->
            <div id="walletModal"
                class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50 flex items-center justify-center">
                <div class="relative p-5 border w-full max-w-md shadow-lg rounded-md bg-gray-800 border-gray-700">
                    <div class="mt-3">


                        <!-- Preview Wallet -->
                        <div id="walletPreview"
                            class="border border-gray-700 shadow-xl rounded-lg cursor-pointer hover:bg-opacity-80 transition-all duration-200 mb-4 mx-auto"
                            style="background-color: #FFFFFF; width: 200px; height: 200px;">
                            <div class="p-4 sm:p-6 flex flex-col justify-end h-full w-full">
                                <div class="text-content">
                                    <p id="previewEmoji" class="text-4xl sm:text-5xl mb-2 sm:mb-4">🪙</p>
                                    <!-- Tampilkan emoji -->
                                    <h3 id="previewName" class="text-lg sm:text-xl font-semibold">Wallet Name</h3>
                                    <p id="previewBalance" class="text-sm sm:text-md">Rp0.00</p>
                                </div>
                            </div>
                        </div>

                        <form action="{{ route('wallets.store') }}" method="POST" class="mt-4">
                            @csrf
                            <div class="mb-2">
                                <label class="block text-gray-200 text-sm font-bold mb-1" for="name">
                                    Wallet Name
                                </label>
                                <input type="text" name="name" id="name" required placeholder="Enter wallet name"
                                    class="w-full rounded-md bg-gray-700 border-gray-600 text-gray-200 focus:border-[#FCD535] focus:ring focus:ring-[#FCD535]/50"
                                    oninput="updatePreview()">
                            </div>
                            <div class="mb-2">
                                <label class="block text-gray-200 text-sm font-bold mb-1" for="balance">
                                    Initial Balance
                                </label>
                                <input type="number" step="0.01" name="balance" id="balance" required placeholder="Enter initial balance"
                                    class="w-full rounded-md bg-gray-700 border-gray-600 text-gray-200 focus:border-[#FCD535] focus:ring focus:ring-[#FCD535]/50"
                                    oninput="updatePreview()">
                            </div>
                            <div class="mb-2">
                                <label class="block text-gray-200 text-sm font-bold mb-1" for="emoji">
                                    Select Emoji
                                </label>
                                <div id="emoji-picker"
                                    class="grid grid-cols-6 gap-2 bg-gray-700 p-2 rounded-md overflow-y-scroll max-h-32 scrollbar-hide">
                                    <!-- Emoji list will be populated here by JavaScript -->
                                </div>
                                <input type="text" name="emoji" id="emoji" required class="hidden"
                                    oninput="updatePreview()">
                            </div>
                            <div class="mb-2">
                                <label class="block text-gray-200 text-sm font-bold mb-1" for="color_hex">
                                    Select Color
                                </label>
                                <input type="color" name="color_hex" id="color_hex" required
                                    class="w-full rounded-md bg-gray-700 border-gray-600 text-gray-200 focus:border-[#FCD535] focus:ring focus:ring-[#FCD535]/50 mt-1 h-10 cursor-pointer"
                                    oninput="updatePreview()">
                            </div>
                            <div class="flex justify-end">
                                <button type="button" onclick="closeModal()"
                                    class="mr-2 px-4 py-2 bg-gray-700 text-gray-200 rounded-md hover:bg-gray-600">
                                    Cancel
                                </button>
                                <button type="submit"
                                    class="px-4 py-2 bg-[#FCD535] text-gray-900 rounded-md hover:bg-[#FCD535]/80">
                                    Add Wallet
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById('walletModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('walletModal').classList.add('hidden');
        }

        document.addEventListener('DOMContentLoaded', function() {
            const emojiPicker = document.getElementById('emoji-picker');
            const emojiInput = document.getElementById('emoji');

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

            // Adjust text color based on background color
            const walletCards = document.querySelectorAll('[data-color]');
            walletCards.forEach(card => {
                const bgColor = card.getAttribute('data-color');
                const textColor = getContrastYIQ(bgColor);
                card.querySelector('.text-content').style.color = textColor;
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

        function updatePreview() {
            const name = document.getElementById('name').value;
            const balance = document.getElementById('balance').value;
            const emoji = document.getElementById('emoji').value;
            const color = document.getElementById('color_hex').value;

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
    <style>
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
        .scrollbar-hide {
            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: none;  /* Firefox */
        }
    </style>
</x-app-layout>
