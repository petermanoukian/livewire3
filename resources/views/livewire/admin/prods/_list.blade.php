<div class="mb-4 flex items-center gap-4">
    <!-- Category Filter -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Filter by Category:</label>
        <select wire:model.live="catid" class="border rounded px-3 py-2">
            <option value="">All Categories</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
            @endforeach
        </select>
    </div>

    <!-- Subcategory Filter -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Filter by Subcategory:</label>
        <select wire:model.live="subcatid" class="border rounded px-3 py-2">
            <option value="">All Subcategories</option>
            @foreach($subcats as $sub)
                <option value="{{ $sub->id }}">{{ $sub->name }}</option>
            @endforeach
        </select>
    </div>
</div>

@include('livewire.admin.common._search')

<form wire:submit.prevent="deleteSelected">
    <table class="table-auto w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-2 border text-center">
                    <input type="checkbox" wire:click="toggleAll">
                    <button type="button" wire:click="invertSelection" class="ml-2 text-xs text-gray-600 underline">
                        Invert
                    </button>
                    <button type="button" wire:click="clearSelection" class="ml-2 text-xs text-red-600 underline">
                        Clear
                    </button>
                </th>

                <livewire:admin.sortable-th-component 
                    field="id" 
                    label="ID" 
                    :order-field="$orderField" 
                    :order-direction="$orderDirection" />

                <livewire:admin.sortable-th-component 
                    field="catid" 
                    label="Category" 
                    :order-field="$orderField" 
                    :order-direction="$orderDirection" />

                <livewire:admin.sortable-th-component 
                    field="subcatid" 
                    label="Subcategory" 
                    :order-field="$orderField" 
                    :order-direction="$orderDirection" />

                <livewire:admin.sortable-th-component 
                    field="name" 
                    label="Name" 
                    :order-field="$orderField" 
                    :order-direction="$orderDirection" />

                <th class="p-2 border">Picture</th>
                <th class="p-2 border">File</th>
                <th class="p-2 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($records as $prod)
                <tr>
                    <td class="p-2 border text-center">
                        <input type="checkbox" wire:model.live="selected" value="{{ $prod->id }}">
                    </td>
                    <td class="p-2 border">{{ $prod->id }}</td>
                    <td class="p-2 border">{{ $prod->prodcat->name ?? 'N/A' }}</td>
                    <td class="p-2 border">{{ $prod->prodsubcat->name ?? 'N/A' }}</td>
                    <td class="p-2 border">{{ $prod->name }}</td>
                    <td class="p-2 border">
                        @if($prod->img2)
                            <img src="{{ asset($prod->img2) }}" alt="pic" class="h-20 w-28 rounded">
                        @else
                            -
                        @endif
                    </td>
                    <td class="p-2 border">
                        @if($prod->filer)
                            <a href="{{ asset($prod->filer) }}" target="_blank" class="text-indigo-600 underline">Download</a>
                        @else
                            -
                        @endif
                    </td>
                    <td class="p-2 border">
                        <button type="button"
                                wire:click="$dispatch('edit-prod', { id: {{ $prod->id }} })"
                                class="text-blue-600 mr-2 underline">
                            Edit
                        </button>
                        <button type="button"
                                onclick="if(confirm('Are you sure you want to delete this product?')) { @this.deleteOne({{ $prod->id }}) }"
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
                    onclick="return confirm('Are you sure you want to delete selected products?')"
                    class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                Delete Selected
            </button>
        </div>
    @endif
</form>

<div class="mt-4">
    {{ $records->links() }}
</div>

