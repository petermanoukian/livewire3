<div x-data="{ open: @entangle('open') }" class="relative w-full">
    <label class="block text-sm font-medium text-gray-700">
        Subcategory
    </label>

    <!-- Dropdown trigger -->
    <div class="mt-1 relative cursor-pointer flex items-center justify-between"
         @click="open = !open">
        <input
            type="text"
            value="{{ $selectedSubcat ? $subcategories->firstWhere('id', $selectedSubcat)?->name : '' }}"
            placeholder="{{ $catid ? 'Search subcategories...' : 'Select a category first' }}"
            class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm
                   focus:outline-none focus:ring focus:ring-indigo-500"
            readonly
        />
        <!-- Caret icon -->
        <svg class="w-4 h-4 text-gray-500 absolute right-3 top-3 pointer-events-none"
             fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
        </svg>
    </div>

    <!-- Dropdown panel -->
    <div x-show="open" @click.away="open = false; $wire.set('search','')"
         class="absolute z-50 mt-1 w-full bg-white border border-gray-300 rounded-md shadow-lg max-h-60 overflow-auto">
        <!-- Search inside panel -->
        <div class="relative">
            <input
                type="text"
                wire:model.live.debounce.300ms="search"
                placeholder="Type to filter..."
                class="w-full px-3 py-2 border-b border-gray-200 focus:outline-none"
            />
            <!-- Clear (X) button -->
            <button type="button"
                    class="absolute right-2 top-2 text-gray-400 hover:text-gray-600"
                    @click="$wire.set('search','')">
                ✕
            </button>
        </div>

        <ul>
            @forelse($subcategories as $subcat)
                <li
                    wire:click="selectSubcat({{ $subcat->id }}, '{{ addslashes($subcat->name) }}')"
                    @click="$wire.set('search','')"  
                    class="px-3 py-2 cursor-pointer hover:bg-indigo-100
                        {{ $selectedSubcat === $subcat->id ? 'bg-indigo-200 font-semibold' : '' }}"
                >
                    {{ $subcat->name }}
                </li>
            @empty
                <li class="px-3 py-2 text-gray-500">
                    {{ $catid ? 'No subcategories found' : 'Select a category first' }}
                </li>
            @endforelse
        </ul>


        <!-- Close button -->
        <div class="border-t px-3 py-2 text-right">
            <button type="button" @click="open = false; $wire.set('search','')"
                    class="text-sm text-red-600 hover:underline">
                Close
            </button>
        </div>
    </div>
</div>
