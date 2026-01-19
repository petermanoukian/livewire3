<?php

namespace App\Livewire\Admin\Cats;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Services\CatService;
use App\Services\Livewire\LivewireImageUploadService;
use App\Services\Livewire\LivewireFileUploaderService;
use App\Livewire\Admin\Validation\CatValidation;
use Livewire\Attributes\On;


class CreateComponent extends Component
{
    use WithFileUploads;


    public ?int $catId = null;
    public bool $isEdit = false;
    public ?string $existingImg = null;
    public ?string $existingFile = null;


    public string $name = '';
    public string $des  = '';
    public string $dess = '';
    public $img;
    public $filer;

    public ?string $flashMessage = null;
    public bool $showForm = false;
    public bool $showFlash = false;
    public int $flashKey = 0;


    protected CatService $cats;
    protected LivewireImageUploadService $imageUpload;
    protected LivewireFileUploaderService $fileUpload;

    public function boot(
        CatService $cats,
        LivewireImageUploadService $imageUpload,
        LivewireFileUploaderService $fileUpload
    ) {
        $this->cats = $cats;
        $this->imageUpload = $imageUpload;
        $this->fileUpload  = $fileUpload;
    }

    public function toggleForm() 
    { 
        $this->showForm = ! $this->showForm; 
    }


    #[On('edit-cat')]
    public function loadCat(int $id)
    {
        $cat = $this->cats->find($id);

        $this->catId = $cat->id;
        $this->isEdit = true;

        $this->name  = $cat->name;
        $this->des   = $cat->des;
        $this->dess  = $cat->dess;

        $this->existingImg  = $cat->img2;
        $this->existingFile = $cat->filer;

        $this->showForm = true;

        $this->dispatch('scroll-to-form');
    }

    #[On('clear-flash')]
    public function clearFlash()
    {
        $this->flashMessage = null;
        $this->showFlash = false;
    }


    protected function rules(): array
    {
        return $this->isEdit && $this->catId
            ? CatValidation::rulesUpdate($this->catId)
            : CatValidation::rulesCreate();
    }

    protected function messages(): array
    {
        return CatValidation::messages();
    }


    public function updatedName()
    {
        $this->validateOnly('name', $this->rules(), $this->messages());
    }

    public function save()
    {
        $data = $this->validate();

        $isUpdate = $this->isEdit && $this->catId;

        if ($this->img) {
            $image = $this->imageUpload->upload(
                $this->img,
                'uploads/cats/img',
                'uploads/cats/img/thumb',
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

        // FILE
        if ($this->filer) {
            $file = $this->fileUpload->prepare(
                $this->filer,
                'uploads/cats/files',
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


        if ($this->isEdit) {
            // keep existing image if no new one uploaded
            if (!$this->img && $this->existingImg) {
                $data['img2'] = $this->existingImg;
            }

            // keep existing file if no new one uploaded
            if (!$this->filer && $this->existingFile) {
                $data['filer'] = $this->existingFile;
            }
        }



    if ($isUpdate) {
        $this->cats->update($this->catId, $data);
        $messagex = 'Category updated successfully.';
        $this->dispatch('cat-updated');
    } else {
        $this->cats->create($data);
        $messagex = 'Category created successfully.';
        $this->dispatch('cat-created');
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
            'catId',
            'isEdit',
            'name',
            'des',
            'dess',
            'img',
            'filer',
            'existingImg',
            'existingFile',
        ]);
    }


    public function render()
    {
        return view('livewire.admin.cats.create-component');
    }
}
