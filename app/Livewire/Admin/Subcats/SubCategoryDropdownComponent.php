<?php

namespace App\Livewire\Admin\Subcats;

use Livewire\Component;
use App\Services\SubcatService;

class SubCategoryDropdownComponent extends Component
{
    public ?int $catid = null;        // Receives from parent or event
    public ?int $selectedSubcat = null;
    public string $search = '';
    public bool $open = false;

    protected SubcatService $subcats;

    public function boot(SubcatService $subcats)
    {
        $this->subcats = $subcats;
    }

    public function mount(?int $catid = null, ?int $subcatid = null)
    {
        $this->catid = $catid;
        $this->selectedSubcat = $subcatid;
    }

    // Listen for category-selected event
    protected $listeners = ['category-selected' => 'setCat'];

    public function setCat(?int $catid)
    {
        $this->catid = $catid;
        $this->selectedSubcat = null; // reset when cat changes
        $this->search = '';
    }

    public function selectSubcat(int $id, string $name)
    {
        $this->selectedSubcat = $id;
        $this->search = $name;
        $this->open = false;

        $this->dispatch('subcat-selected', subcatid: $id);
    }

    public function updatedSelectedSubcat($value)
    {
        $this->dispatch('subcat-selected', subcatid: $value ? (int) $value : null);
    }

    public function render()
    {
        $subcategories = [];

        if ($this->catid) {
            $subcategories = $this->search === ''
                ? $this->subcats->getByCatId($this->catid, ['id', 'name'])
                : $this->subcats->searchByCatIdAndName($this->catid, $this->search, ['id', 'name'], ['name' => 'asc']);
        }

        return view('livewire.admin.subcats.sub-category-dropdown-component', [
            'subcategories' => $subcategories,
        ]);
    }
}
