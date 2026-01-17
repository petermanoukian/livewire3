<th
    class="p-2 border cursor-pointer select-none"
    wire:click="$dispatch('sort-by', { field: '{{ $field }}' })"
>

    {{ $label }}
    <span class="ml-1 text-gray-500">
        @if ($orderField === $field)
            {{ $orderDirection === 'asc' ? '▲' : '▼' }}
        @else
            ↕
        @endif
    </span>
</th>
