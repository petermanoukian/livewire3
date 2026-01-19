<?php

namespace App\Livewire\Admin\Subcats;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Services\SubcatService;
use App\Services\CatService;
use App\Services\Livewire\LivewireImageUploadService;
use App\Services\Livewire\LivewireFileUploaderService;
use App\Livewire\Admin\Validation\SubcatValidation;
use Livewire\Attributes\On;

class SubcatComponent extends Component
{
    use WithPagination, WithFileUploads;

    // --- Form state ---
    public ?int $subcatId = null;
    public ?int $catid = null; // parent category filter
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

    protected SubcatService $subcats;
    protected LivewireImageUploadService $imageUpload;
    protected LivewireFileUploaderService $fileUpload;
    protected CatService $cats;

    public function boot(
        SubcatService $subcats,
        LivewireImageUploadService $imageUpload,
        LivewireFileUploaderService $fileUpload,
        CatService $cats
        
    ) {
        $this->subcats = $subcats;
        $this->imageUpload = $imageUpload;
        $this->fileUpload  = $fileUpload;
        $this->cats = $cats;
    }

    
    public function mount(?int $catid = null)
    {
        // If catid is passed via URL/route, set it
        if ($catid) {
            $this->catid = $catid;
            // Dispatch to dropdown to pre-select
            $this->dispatch('set-selected-category', catid: $catid);
        }
    }



    public function toggleForm()
    {
        $this->showForm = ! $this->showForm;
        
        // When showing form, sync the dropdown with current catid
        if ($this->showForm && $this->catid) {
            $this->dispatch('set-selected-category', catid: $this->catid);
        }
    }

    #[On('category-selected')]
    public function setCategoryId(?int $catid)
    {
        $this->catid = $catid;

        // Clear previous validation error
        $this->resetValidation('name');

        // Revalidate name IF user already typed something
        if ($this->name !== '') {
            $this->validateOnly('name', $this->rules(), $this->messages());
        }
    }


    #[On('edit-subcat')]
    public function loadSubcat(int $id)
    {
        $subcat = $this->subcats->find($id);

        $this->subcatId = $subcat->id;
        $this->catid    = $subcat->catid;
        $this->isEdit   = true;

        $this->name  = $subcat->name;
        $this->des   = $subcat->des;
        $this->dess  = $subcat->dess;

        $this->existingImg  = $subcat->img2;
        $this->existingFile = $subcat->filer;

        $this->showForm = true;
        
        // Dispatch event to set the dropdown value
        $this->dispatch('set-selected-category', catid: $this->catid);
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
        return $this->isEdit && $this->subcatId
            ? SubcatValidation::rulesUpdate($this->subcatId, $this->catid)
            : SubcatValidation::rulesCreate($this->catid);
    }

    protected function messages(): array
    {
        return SubcatValidation::messages();
    }

    public function updatedName()
    {
        $this->validateOnly('name', $this->rules(), $this->messages());
    }

    public function updatedCatid()
    {
        $this->resetValidation('name');

        if ($this->name !== '') {
            $this->validateOnly('name', $this->rules(), $this->messages());
        }
    }


    // --- Save ---
    public function save()
    {
        $data = $this->validate();
        $isUpdate = $this->isEdit && $this->subcatId;

        // image upload
        if ($this->img) {
            $image = $this->imageUpload->upload(
                $this->img,
                'uploads/subcats/img',
                'uploads/subcats/img/thumb',
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
                'uploads/subcats/files',
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
            $this->subcats->update($this->subcatId, $data);
            $messagex = 'Subcategory updated successfully.';
            $this->dispatch('subcat-updated');
        } else {
            $this->subcats->create($data);
            $messagex = 'Subcategory created successfully.';
            $this->dispatch('subcat-created');
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
            'subcatId',
            'catid',
            'isEdit',
            'name',
            'des',
            'dess',
            'img',
            'filer',
            'existingImg',
            'existingFile',
        ]);
        
        // Reset the dropdown too
        $this->dispatch('set-selected-category', catid: null);
    }

    // --- Listing ---
    #[On('subcat-created')]
    #[On('subcat-updated')]
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
        'created_at',
    ];

    public function deleteSelected()
    {
        if ($this->selected) {
            $this->subcats->deleteMany($this->selected);
            $this->selected = [];
            $this->flashMessage = 'Selected subcategories deleted successfully.';
            $this->showFlash = true;
            $this->flashKey++;
        }
    }

    public function deleteOne(int $id)
    {
        $this->subcats->deleteMany([$id]);
        $this->flashMessage = 'Subcategory deleted successfully.';
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

        if ($this->search !== '') {
            return $this->subcats->searchPaginated(
                $this->search,
                $this->perPage,
                ['id', 'catid', 'name', 'img2', 'filer'],
                ['cat'],
                false,
                'or',
                [$field => $direction]
            );
        }

        return $this->subcats->paginate(
            $this->perPage,
            ['id', 'catid', 'name', 'img2', 'filer'],
            $filters,
            ['cat'],
            [$field => $direction]
        );
    }

    public function render()
    {
        $records = $this->currentRecords();
         $categories = $this->cats->all(['id', 'name']);

        return view('livewire.admin.subcats.subcat-component', [
            'records' => $records,
            'categories' => $categories,
            'catid'   => $this->catid,
        ]);
    }
}
