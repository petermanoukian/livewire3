<div class="relative w-full">
    <label class="block text-sm font-medium text-gray-700">
        Category
    </label>

    <!-- Dropdown trigger / visible area -->
    <div 
        class="mt-1 relative cursor-pointer"
        wire:click="$set('open', true)"
    >
        <input
            type="text"
            wire:model.live.debounce.300ms="search"
            placeholder="{{ $selectedCat ? 'Selected: '.$categories->firstWhere('id', $selectedCat)?->name : 'Search categories...' }}"
            class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm
                   focus:outline-none focus:ring focus:ring-indigo-500"
            readonly
        />
    </div>

    <!-- Dropdown panel -->
    @if($open)
        <div class="absolute z-50 mt-1 w-full bg-white border border-gray-300 rounded-md shadow-lg max-h-60 overflow-auto">
            <!-- Search inside panel -->
            <input
                type="text"
                wire:model.live.debounce.300ms="search"
                placeholder="Type to filter..."
                class="w-full px-3 py-2 border-b border-gray-200 focus:outline-none"
            />

            <ul>
                @forelse($categories as $cat)
                    <li
                        wire:click="selectCategory({{ $cat->id }}, '{{ addslashes($cat->name) }}')"
                        class="px-3 py-2 cursor-pointer hover:bg-indigo-100"
                    >
                        {{ $cat->name }}
                    </li>
                @empty
                    <li class="px-3 py-2 text-gray-500">No categories found</li>
                @endforelse
            </ul>
        </div>
    @endif
</div>



