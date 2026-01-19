<?php

namespace App\Livewire\Admin\Cats;

use Livewire\Component;
use App\Services\CatService;

class CategoryDropdownComponent extends Component
{
    public ?int $catid = null;  // Receives from parent
    public ?int $selectedCat = null;
    public string $search = '';
    public bool $open = false;


    protected CatService $cats;

    public function boot(CatService $cats)
    {
        $this->cats = $cats;
    }



    public function mount(?int $catid = null)
    {
        $this->catid = $catid;  // ADD THIS LINE - store the received catid
        $this->selectedCat = $catid;  // Set selectedCat for the dropdown
    }

   

    public function selectCategory(int $id, string $name)
    {
        $this->selectedCat = $id;
        $this->search = $name;
        $this->open = false;

        $this->dispatch('category-selected', catid: $id);
    }


    public function updatedSelectedCat($value)
    {
        $this->dispatch('category-selected', catid: $value ? (int) $value : null);
    }

    public function render()
    {
        $categories = $this->search === ''
            ? $this->cats->all(['id', 'name'], [], [],['name' => 'asc'])
            : $this->cats->searchByName($this->search, ['id', 'name'], ['name' => 'asc']);

        return view('livewire.admin.cats.category-dropdown-component', [
            'categories' => $categories,
        ]);
    }


}