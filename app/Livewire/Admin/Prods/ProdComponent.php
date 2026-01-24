<?php

namespace App\Livewire\Admin\Prods;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Services\ProdService;
use App\Services\CatService;
use App\Services\SubcatService;
use App\Services\Livewire\LivewireImageUploadService;
use App\Services\Livewire\LivewireFileUploaderService;
use App\Livewire\Admin\Validation\ProdValidation;
use Livewire\Attributes\On;

class ProdComponent extends Component
{
    use WithPagination, WithFileUploads;

    // --- Form state ---
    public ?int $prodId = null;
    public ?int $catid = null;
    public ?int $subcatid = null;
    public bool $isEdit = false;
    public bool $showForm = false;

    public string $name = '';
    public string $des  = '';
    public string $dess = '';
    public $img;
    public $filer;

    public ?string $existingImg = null;
    public ?string $existingFile = null;

    // --- Flash state ---
    public ?string $flashMessage = null;
    public bool $showFlash = false;
    public int $flashKey = 0;

    // --- List state ---
    public array $selected = [];
    public int $perPage = 5;
    public string $search = '';
    public string $orderField = 'id';
    public string $orderDirection = 'desc';

    protected ProdService $prods;
    protected LivewireImageUploadService $imageUpload;
    protected LivewireFileUploaderService $fileUpload;
    protected CatService $cats;
    protected SubcatService $subcats;

    public function boot(
        ProdService $prods,
        LivewireImageUploadService $imageUpload,
        LivewireFileUploaderService $fileUpload,
        CatService $cats,
        SubcatService $subcats
    ) {
        $this->prods       = $prods;
        $this->imageUpload = $imageUpload;
        $this->fileUpload  = $fileUpload;
        $this->cats        = $cats;
        $this->subcats     = $subcats;
    }

    public function mount(?int $catid = null, ?int $subcatid = null)
    {
        if ($catid) {
            $this->catid = $catid;
            $this->dispatch('set-selected-category', catid: $catid);
        }
        if ($subcatid) {
            $this->subcatid = $subcatid;
            $this->dispatch('set-selected-subcategory', subcatid: $subcatid);
        }
    }

    public function toggleForm()
    {
        $this->showForm = ! $this->showForm;

        if ($this->showForm) {
            if ($this->catid) {
                $this->dispatch('set-selected-category', catid: $this->catid);
            }
            if ($this->subcatid) {
                $this->dispatch('set-selected-subcategory', subcatid: $this->subcatid);
            }
        }
    }

    #[On('category-selected')]
    public function setCategoryId(?int $catid)
    {
        $this->catid = $catid;
        $this->resetValidation('name');
        if ($this->name !== '') {
            $this->validateOnly('name', $this->rules(), $this->messages());
        }
    }

    #[On('subcat-selected')]
    public function setSubcategoryId(?int $subcatid)
    {
        $this->subcatid = $subcatid;
        $this->resetValidation('name');
        if ($this->name !== '') {
            $this->validateOnly('name', $this->rules(), $this->messages());
        }
    }



    

    #[On('edit-prod')]
    public function loadProd(int $id)
    {
        $prod = $this->prods->find($id);

        $this->prodId   = $prod->id;
        $this->catid    = $prod->catid;
        $this->subcatid = $prod->subcatid;
        $this->isEdit   = true;

        $this->name     = $prod->name;
        $this->des      = $prod->des;
        $this->dess     = $prod->dess;

        $this->existingImg  = $prod->img2;
        $this->existingFile = $prod->filer;

        $this->showForm = true;

        $this->dispatch('set-selected-category', catid: $this->catid);
        $this->dispatch('set-selected-subcategory', subcatid: $this->subcatid);
        $this->dispatch('scroll-to-form');
    }

    #[On('clear-flash')]
    public function clearFlash()
    {
        $this->flashMessage = null;
        $this->showFlash = false;
    }

    // --- Validation ---
    protected function rules(): array
    {
        return $this->isEdit && $this->prodId
            ? ProdValidation::rulesUpdate($this->prodId, $this->catid, $this->subcatid)
            : ProdValidation::rulesCreate($this->catid, $this->subcatid);
    }

    protected function messages(): array
    {
        return ProdValidation::messages();
    }

    public function updatedName()
    {
        $this->validateOnly('name', $this->rules(), $this->messages());
    }

        // --- Save ---
    public function save()
    {
        $data = $this->validate();
        $isUpdate = $this->isEdit && $this->prodId;

        // image upload
        if ($this->img) {
            $image = $this->imageUpload->upload(
                $this->img,
                'uploads/prods/img',
                'uploads/prods/img/thumb',
                1500,
                1000,
                $this->name,
                200,
                200
            );
            if ($image) {
                $data['img']  = $image['large'];
                $data['img2'] = $image['small'];
            }
        }

        // file upload
        if ($this->filer) {
            $file = $this->fileUpload->prepare(
                $this->filer,
                'uploads/prods/files',
                $this->name,
                uniqid()
            );
            if ($file) {
                $target = public_path($file['path']);
                if (!is_dir(dirname($target))) {
                    mkdir(dirname($target), 0755, true);
                }
                file_put_contents(
                    $target,
                    file_get_contents($file['file']->getRealPath())
                );
                $data['filer'] = $file['path'];
            }
        }

        // keep existing if not replaced
        if ($this->isEdit) {
            if (!$this->img && $this->existingImg) {
                $data['img2'] = $this->existingImg;
            }
            if (!$this->filer && $this->existingFile) {
                $data['filer'] = $this->existingFile;
            }
        }

        // persist
        if ($isUpdate) {
            $this->prods->update($this->prodId, $data);
            $messagex = 'Product updated successfully.';
            $this->dispatch('prod-updated');
        } else {
            $this->prods->create($data);
            $messagex = 'Product created successfully.';
            $this->dispatch('prod-created');
        }

        $this->flashMessage = "$messagex : $this->name";
        $this->showFlash = true;
        $this->flashKey++;
        $this->dispatch('auto-hide-flash');

        $this->dispatch('scroll-to-cats');
        $this->resetForm();
        $this->showForm = false;
    }

    public function resetForm()
    {
        $this->reset([
            'prodId',
            'catid',
            'subcatid',
            'isEdit',
            'name',
            'des',
            'dess',
            'img',
            'filer',
            'existingImg',
            'existingFile',
        ]);

        $this->dispatch('set-selected-category', catid: null);
        $this->dispatch('set-selected-subcategory', subcatid: null);
    }

    // --- Listing ---
    #[On('prod-created')]
    #[On('prod-updated')]
    public function refreshList()
    {
        $this->resetPage();
        $this->selected = [];
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
        'catid',
        'subcatid',
        'created_at',
    ];

    public function deleteSelected()
    {
        if ($this->selected) {
            $this->prods->deleteMany($this->selected);
            $this->selected = [];
            $this->flashMessage = 'Selected products deleted successfully.';
            $this->showFlash = true;
            $this->flashKey++;
        }
    }

    public function deleteOne(int $id)
    {
        $this->prods->deleteMany([$id]);
        $this->flashMessage = 'Product deleted successfully.';
        $this->showFlash = true;
        $this->flashKey++;
    }

    protected function currentRecords()
    {
        $field = in_array($this->orderField, $this->allowedOrderFields)
            ? $this->orderField
            : 'id';

        $direction = $this->orderDirection === 'asc' ? 'asc' : 'desc';

        $filters = [];
        if ($this->catid) {
            $filters['catid'] = $this->catid;
        }
        if ($this->subcatid) {
            $filters['subcatid'] = $this->subcatid;
        }

        if ($this->search !== '') {
            return $this->prods->searchPaginated(
                $this->search,
                $this->perPage,
                ['id', 'catid', 'subcatid', 'name', 'img2', 'filer'],
                ['prodcat', 'prodsubcat'],
                false,
                'or',
                [$field => $direction]
            );
        }

        return $this->prods->paginate(
            $this->perPage,
            ['id', 'catid', 'subcatid', 'name', 'img2', 'filer'],
            $filters,
            ['prodcat', 'prodsubcat'],
            [$field => $direction]
        );
    }

    public function render()
    {
        $records    = $this->currentRecords();
        $categories = $this->cats->all(['id', 'name']);
        $subcats    = $this->subcats->all(['id', 'catid', 'name']);

        return view('livewire.admin.prods.prod-component', [
            'records'    => $records,
            'categories' => $categories,
            'subcats'    => $subcats,
            'catid'      => $this->catid,
            'subcatid'   => $this->subcatid,
        ]);
    }
}

