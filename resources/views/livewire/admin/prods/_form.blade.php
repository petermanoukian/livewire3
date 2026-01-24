<div>
    <!-- Toggle form button -->
    <button type="button"
            wire:click="toggleForm"
            class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
        {{ $showForm ? 'Hide Form' : 'Add New Product' }}
    </button>


        <!-- Preloader -->
    <div wire:loading wire:target="toggleForm, save"
         class="mt-4 flex items-center justify-center">
        <svg class="animate-spin h-6 w-6 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10"
                    stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor"
                  d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
        </svg>
        <span class="ml-2 text-indigo-600">Loading...</span>
    </div>

    <!-- Flash message -->
    @if ($showFlash)
        <div
            wire:key="flash-{{ $flashKey }}-visible"
            class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4"
        >
            {{ $flashMessage }}
        </div>
    @endif

    <!-- Form -->
    @if($showForm)
        <h3 class="text-lg font-semibold mb-4">
            {{ $isEdit ? 'Edit Product' : 'New Product' }}
        </h3>

        <form wire:submit.prevent="save" enctype="multipart/form-data">
            <!-- Parent category dropdown -->
            <div class="mb-4">
                <livewire:admin.cats.category-dropdown-component :catid="$catid" :key="'cat-dropdown-'.($prodId ?? 'new')" />
                @error('catid') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Parent subcategory dropdown -->
            <div class="mb-4">
                <livewire:admin.subcats.sub-category-dropdown-component :subcatid="$subcatid" :catid="$catid" :key="'subcat-dropdown-'.($prodId ?? 'new')" />
                @error('subcatid') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Name -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" wire:model.live.debounce.500ms="name"
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm
                              focus:outline-none focus:ring focus:ring-indigo-500">
                @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

                        <!-- Description -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Description</label>
                <textarea wire:model="des"
                          class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm
                                 focus:outline-none focus:ring focus:ring-indigo-500"
                          rows="4"></textarea>
                @error('des') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Extra description -->
            <div class="mb-4" wire:ignore>
                <label class="block text-sm font-medium text-gray-700">Extra Description</label>
                <input id="dess" type="hidden" wire:model.defer="dess">
                <trix-editor input="dess"
                             class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm"></trix-editor>
                @error('dess') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Image + File -->
            <div class="flex gap-4 mb-4">
                <div class="w-1/2">
                    <label class="block text-sm font-medium text-gray-700">Image</label>
                    <input type="file" wire:model="img">
                    @error('img') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror

                    @if ($img)
                        <div class="mt-2">
                            <img src="{{ $img->temporaryUrl() }}" class="h-20 w-28 rounded border">
                        </div>
                    @elseif($existingImg)
                        <div class="mt-2">
                            <img src="{{ asset($existingImg) }}" class="h-20 w-28 rounded">
                        </div>
                    @endif
                </div>

                <div class="w-1/2">
                    <label class="block text-sm font-medium text-gray-700">File</label>
                    <input type="file" wire:model="filer">
                    @error('filer') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror

                    @if($existingFile && !$filer)
                        <div class="mt-2">
                            <a href="{{ asset($existingFile) }}" target="_blank" class="text-indigo-600 underline">
                                Current file
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Buttons -->
            <button type="submit" @disabled($errors->isNotEmpty())
                    class="px-4 py-2
                           {{ $isEdit ? 'bg-green-600 hover:bg-green-700' : 'bg-indigo-600 hover:bg-indigo-700' }}
                           text-white rounded disabled:cursor-not-allowed disabled:opacity-50">
                {{ $isEdit ? 'Update' : 'Save' }}
            </button>

            @if($isEdit)
                <button type="button"
                        wire:click="resetForm"
                        class="ml-2 px-4 py-2 bg-gray-500 text-white rounded">
                    Cancel
                </button>
            @endif
        </form>
    @endif
</div>

