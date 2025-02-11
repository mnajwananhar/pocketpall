<x-app-layout>
    <div class="flex items-center justify-center min-h-screen py-12 relative m-5">
        <div class="max-w-2xl w-full sm:px-6 lg:px-8">
            <div class="bg-white/10 backdrop-filter backdrop-blur-lg shadow-xl sm:rounded-lg border border-gray-700 mx-auto">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-semibold text-white">Categories</h2>
                        <button onclick="openModal()"
                            class="px-4 py-2 bg-[#FCD535] text-gray-900 rounded-md hover:bg-[#FCD535]/80 transition-colors duration-200">
                            Add Category
                        </button>
                    </div>

                    <!-- Categories Table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-700">
                            <thead class="bg-gray-800/50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                        Name</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                        Description</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-gray-800/30 divide-y divide-gray-700">
                                @foreach ($categories->sortByDesc('is_default') as $category)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-200">{{ $category->name }}</td>
                                        <td class="px-6 py-4 text-gray-200">{{ $category->description }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                            @if (!$category->is_default)
                                                <button
                                                    onclick="openEditModal({{ $category->id }}, '{{ $category->name }}', '{{ $category->description }}', {{ $category->is_default ? 'true' : 'false' }})"
                                                    class="text-[#FCD535] hover:text-[#FCD535]/80">
                                                    Edit
                                                </button>
                                                <form action="{{ route('categories.destroy', $category) }}"
                                                    method="POST" class="inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-400 hover:text-red-300"
                                                        onclick="return confirm('Are you sure?')">
                                                        Delete
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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

        @if (session('delete'))
            <div class="absolute top-0 left-1/2 transform -translate-x-1/2 mt-4 bg-red-500 text-white p-4 rounded-lg shadow-lg notification opacity-0 transition-opacity duration-500">
                {{ session('delete') }}
            </div>
        @endif
    </div>

    <!-- Modal -->
    <div id="categoryModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-gray-800 border-gray-700">
            <div class="mt-3">
                <h3 class="text-lg font-medium text-gray-200" id="modalTitle">Add Category</h3>
                <form id="categoryForm" method="POST" action="{{ route('categories.store') }}" class="mt-4">
                    @csrf
                    <div class="mt-2">
                        <input type="hidden" id="categoryId" name="category_id">
                        <div class="mb-4">
                            <label class="block text-gray-200 text-sm font-bold mb-2">Name</label>
                            <input type="text" name="name" id="categoryName" required
                                placeholder="Enter category name"
                                class="w-full rounded-md bg-gray-700 border-gray-600 text-gray-200 focus:border-[#FCD535] focus:ring focus:ring-[#FCD535]/50">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-200 text-sm font-bold mb-2">Description</label>
                            <textarea name="description" id="categoryDescription"
                                placeholder="Enter category description"
                                class="w-full rounded-md bg-gray-700 border-gray-600 text-gray-200 focus:border-[#FCD535] focus:ring focus:ring-[#FCD535]/50"></textarea>
                        </div>
                    </div>
                    <div class="flex justify-end mt-4">
                        <button type="button" onclick="closeModal()"
                            class="mr-2 px-4 py-2 bg-gray-700 text-gray-200 rounded-md hover:bg-gray-600">
                            Cancel
                        </button>
                        <button type="submit"
                            class="px-4 py-2 bg-[#FCD535] text-gray-900 rounded-md hover:bg-[#FCD535]/80">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById('modalTitle').textContent = 'Add Category';
            document.getElementById('categoryForm').action = "{{ route('categories.store') }}";
            document.getElementById('categoryId').value = '';
            document.getElementById('categoryName').value = '';
            document.getElementById('categoryDescription').value = '';
            document.getElementById('categoryModal').classList.remove('hidden');
        }

        function openEditModal(id, name, description, isDefault) {
            if (isDefault) {
                alert('Default categories cannot be edited.');
                return;
            }
            document.getElementById('modalTitle').textContent = 'Edit Category';
            document.getElementById('categoryForm').action = `/categories/${id}`;
            document.getElementById('categoryForm').insertAdjacentHTML('beforeend',
                '<input type="hidden" name="_method" value="PUT">');
            document.getElementById('categoryId').value = id;
            document.getElementById('categoryName').value = name;
            document.getElementById('categoryDescription').value = description;
            document.getElementById('categoryModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('categoryModal').classList.add('hidden');
        }

        // Show notifications with animation
        document.addEventListener('DOMContentLoaded', () => {
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
</x-app-layout>
