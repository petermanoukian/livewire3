<?php

namespace App\Livewire\Admin\Cats;

use Livewire\Component;
use Livewire\WithPagination;
use App\Services\CatService;
use Livewire\Attributes\On;


class ViewComponent extends Component
{
    use WithPagination;

    public array $selected = [];
    public int $perPage = 5;
    public string $search = '';
    public string $orderField = 'id';
    public string $orderDirection = 'desc';

    protected function catService(): CatService
    {
        return app(CatService::class);
    }

    #[On('cat-created')]
    #[On('cat-updated')]
    public function refreshList()
    {
        $this->resetPage();   // pagination safety
        $this->selected = []; // clear selection
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedPerPage()
    {
        $this->resetPage();
    }

    public function updatedOrderField()
    {
        $this->resetPage();
    }

    public function updatedOrderDirection()
    {
        $this->resetPage();
    }


    public function clearSelection()
    {
        $this->selected = [];
    }


    #[On('sort-by')]
    public function sortBy(string $field)
    {
        if ($this->orderField === $field) {
            $this->orderDirection = $this->orderDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->orderField = $field;
            $this->orderDirection = 'asc';
        }

        $this->resetPage();
    }


    protected array $allowedOrderFields = [
        'id',
        'name',
        'created_at',
    ];



    /**
     * Delete selected
     */
    public function deleteSelected()
    {
        if ($this->selected) {
            $this->catService()->deleteMany($this->selected);
            $this->selected = [];
            session()->flash('success', 'Selected cats deleted successfully.');
        }
    }

    public function deleteOne(int $id)
    {
        $this->catService()->deleteMany([$id]);
        session()->flash('success', 'Cat deleted successfully.');
    }

    /**
     * Toggle all visible rows
     */
    public function toggleAll()
    {
        $records = $this->currentRecords();
        $ids = $records->pluck('id')->map(fn ($id) => (string) $id)->toArray();

        $this->selected = count($this->selected) === count($ids) ? [] : $ids;
    }

    public function invertSelection()
    {
        $records = $this->currentRecords();
        $ids = $records->pluck('id')->map(fn ($id) => (string) $id)->toArray();

        $this->selected = array_values(array_diff($ids, $this->selected));
    }



    protected function currentRecords()
    {
        $field = in_array($this->orderField, $this->allowedOrderFields)
            ? $this->orderField
            : 'id';

        $direction = $this->orderDirection === 'asc' ? 'asc' : 'desc';

        if ($this->search !== '') {
            return $this->catService()->searchPaginated(
                $this->search,
                $this->perPage,
                ['id', 'name', 'img2', 'filer'],
                [],
                false,
                'or',
                [$field => $direction]
            );
        }

        return $this->catService()->paginate(
            $this->perPage,
            ['id', 'name', 'img2', 'filer'],
            [],
            [],
            [$field => $direction]
        );
    }



    public function render()
    {
        $records = $this->currentRecords();

        return view('livewire.admin.cats.view-component', [
            'records' => $records,
        ]);
    }
}

