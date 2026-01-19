<div>

    <button type="button"
            wire:click="toggleForm"
            class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
        {{ $showForm ? 'Hide Form' : 'Add New Cat' }}
    </button>

    @if($showForm)
    <h3 class="text-lg font-semibold mb-4">
        {{ $isEdit ? 'Edit Category' : 'New Category' }}
    </h3>


    <form wire:submit.prevent="save" enctype="multipart/form-data">
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" wire:model.live.debounce.500ms="name"
            class="mt-1 block w-full px-3 py-2 border
            border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-indigo-500">
            @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Description</label>
            <textarea wire:model="des"
                     class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-indigo-500"
          rows="4"></textarea>
            @error('des') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4" wire:ignore>
            <label class="block text-sm font-medium text-gray-700">
                Extra Description
            </label>

            <!-- Hidden input bound to Livewire -->
            <input id="dess"
                type="hidden"
                wire:model.defer="dess">

            <!-- Trix editor -->
            <trix-editor
                input="dess"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
            </trix-editor>

            @error('dess')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>


        <div class="flex gap-4 mb-4">
            <!-- Image upload -->
            <div class="w-1/2">
                <label class="block text-sm font-medium text-gray-700">Image</label>
                <input type="file" wire:model="img">
                @error('img') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror

                {{-- NEW preview when selecting --}}
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

            <!-- File upload -->
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

@if ($showFlash)
    <div
        wire:key="flash-{{ $flashKey }}-visible"
        class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4"
    >
        {{ $flashMessage }}
    </div>
@endif

</div>

<script>
document.addEventListener('livewire:init', () => {
    Livewire.on('auto-hide-flash', () => {
        setTimeout(() => {
            Livewire.dispatch('clear-flash');
        }, 4000);
    });
});
</script>


