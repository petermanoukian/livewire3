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
               wire:model.live.debounce.500ms="search"
               class="border rounded px-2 py-1"
               placeholder="Search...">
    </div>
</div>
