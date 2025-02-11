<x-app-layout>
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Edit Wallet</h2>

                    <!-- Edit Wallet Form -->
                    <form action="{{ route('wallets.update', $wallet) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label class="block font-medium text-gray-700 mb-2">Wallet Name</label>
                            <input type="text" name="name" value="{{ old('name', $wallet->name) }}" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium text-gray-700 mb-2">Balance</label>
                            <input type="number" name="balance" step="0.01"
                                value="{{ old('balance', $wallet->balance) }}" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium text-gray-700 mb-2">Select Emoji</label>
                            <div id="emoji-picker"
                                class="grid grid-cols-6 gap-2 bg-gray-100 p-2 rounded-md overflow-y-auto max-h-32">
                                <!-- Emoji list will be populated here by JavaScript -->
                            </div>
                            <input type="text" name="emoji" id="emoji"
                                value="{{ old('emoji', $wallet->emoji) }}" required class="hidden">
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium text-gray-700 mb-2">Select Color</label>
                            <input type="color" name="color_hex" id="color_hex"
                                value="{{ old('color_hex', $wallet->color_hex) }}" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        </div>

                        <div class="flex justify-end">
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition ease-in-out duration-150">
                                Update Wallet
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
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
                emojiButton.classList.add('text-2xl', 'p-1', 'hover:bg-gray-200', 'rounded');
                emojiButton.innerText = emoji;
                emojiButton.addEventListener('click', () => {
                    emojiInput.value = emoji;
                });
                emojiPicker.appendChild(emojiButton);
            });
        });
    </script>
</x-app-layout>
