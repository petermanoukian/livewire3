<div>
    {{-- Flash message --}}
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <hr class="flex items-center mb-4 space-x-4 mt-8">

    <div class="flex items-center mb-4 space-x-4 mt-4">
        <div>
            <label>Records per page:</label>
            <select wire:model.live="perPage" class="border rounded px-2 py-1">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="15">15</option>
                <option value="25">25</option>
                <option value="50">50</option>
            </select>
        </div>

        <div>
            <label>Search:</label>
            <input type="text"
                wire:model.live.debounce.500ms ="search"
                class="border rounded px-2 py-1"
                placeholder="Search cats...">
        </div>
    </div>


    <form wire:submit.prevent="deleteSelected">
        <table class="table-auto w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-2 border text-center">
                        <input type="checkbox" wire:click="toggleAll">
                        <button type="button" wire:click="invertSelection" class="ml-2 text-xs text-gray-600 underline">
                            Invert
                        </button>

                        <button type="button"
                            wire:click="clearSelection"
                            class="ml-2 text-xs text-red-600 underline">
                            Clear
                        </button>

                    </th>

                    <livewire:admin.sortable-th-component 
                        field="id" 
                        label="ID" 
                        :order-field="$orderField" 
                        :order-direction="$orderDirection" />

                    <livewire:admin.sortable-th-component 
                        field="name" 
                        label="Name" 
                        :order-field="$orderField" 
                        :order-direction="$orderDirection" 
                    />

                    <th class="p-2 border">Picture</th>
                    <th class="p-2 border">File</th>
                    <th class="p-2 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($records as $cat)
                    <tr>
                        <td class="p-2 border text-center">
                        <input type="checkbox" wire:model.live="selected" value="{{ (string) $cat->id }}">
                        </td>
                        <td class="p-2 border">{{ $cat->id }}</td>
                        <td class="p-2 border">{{ $cat->name }}</td>
                        <td class="p-2 border">
                            @if($cat->img2)
                                <img src="{{ asset($cat->img2) }}" alt="pic" class="h-20 w-28 rounded">
                            @else
                                -
                            @endif
                        </td>
                        <td class="p-2 border">
                            @if($cat->filer)
                                <a href="{{ asset($cat->filer) }}" target="_blank" class="text-indigo-600 underline">Download</a>
                            @else
                                -
                            @endif
                        </td>
                       
                        <td class="p-2 border">
                            <button type="button"
                                wire:click="$dispatch('edit-cat', { id: {{ $cat->id }} })"
                                class="text-blue-600 mr-2 underline">
                                Edit
                            </button>

                            <button type="button"
                                    onclick="if(confirm('Are you sure you want to delete this cat?')) { @this.deleteOne({{ $cat->id }}) }"
                                    class="text-red-600 hover:underline">
                                Delete
                            </button>

                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>

        @if(count($selected) > 0)
            <div class="mt-4">
                <button type="submit"
                        onclick="return confirm('Are you sure you want to delete selected cats?')"
                        class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                    Delete Selected
                </button>
            </div>
        @endif




    </form>

    <div class="mt-4">
        {{ $records->links() }}
    </div>
</div>
