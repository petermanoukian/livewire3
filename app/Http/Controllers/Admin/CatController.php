<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CatRequest;
use App\Services\CatService;
use App\Services\ImageUploadService;
use App\Services\FileUploaderService;

class CatController extends Controller
{
    protected CatService $cats;
    protected ImageUploadService $imageUploadService;
    protected FileUploaderService $fileUploaderService;

    public function __construct(
        CatService $cats,
        ImageUploadService $imageUploadService,
        FileUploaderService $fileUploaderService
    ) {
        $this->cats = $cats;
        $this->imageUploadService = $imageUploadService;
        $this->fileUploaderService = $fileUploaderService;
    }

    public function index()
    {
        return view('admin.cats.index');
    }

    public function create()
    {
        return view('admin.cats.create');
    }

    public function store(CatRequest $request)
    {
        $data = $request->validated();

        $uploadImg = $this->imageUploadService->upload(
            $request,
            'img',
            'uploads/cats/img',
            'uploads/cats/img/thumb',
            1500,
            1000,
            null,
            200,
            200
        );
        if ($uploadImg) {
            $data['img']  = $uploadImg['large'];
            $data['img2'] = $uploadImg['small'];
        }

        $uploadFile = $this->fileUploaderService->upload(
            $request,
            'filer',
            'uploads/cats/files',
            $data['name'] ?? 'catfile',
            uniqid()
        );
        if ($uploadFile) {
            $data['filer'] = $uploadFile['path'];
        }

        $this->cats->create($data);

        $context = $request->input('context', 'blade');
        if ($context === 'livewire') {
            return redirect()
                ->route('admin.cats.live.index')
                ->with('success', 'Cat created successfully.');
        }

        return redirect()
            ->route('admin.cats.index')
            ->with('success', 'Cat created successfully.');
    }

    public function update(CatRequest $request, int $id)
    {
        $data = $request->validated();

        $uploadImg = $this->imageUploadService->upload(
            $request,
            'img',
            'uploads/cats/img',
            'uploads/cats/img/thumb',
            1500,
            1000,
            null,
            200,
            200
        );
        if ($uploadImg) {
            $data['img']  = $uploadImg['large'];
            $data['img2'] = $uploadImg['small'];
        }

        $uploadFile = $this->fileUploaderService->upload(
            $request,
            'filer',
            'uploads/cats/files',
            $data['name'] ?? 'catfile',
            uniqid()
        );
        if ($uploadFile) {
            $data['filer'] = $uploadFile['path'];
        }

        $this->cats->update($id, $data);

        $context = $request->input('context', 'blade');
        if ($context === 'livewire') {
            return redirect()
                ->route('admin.cats.live.index')
                ->with('success', 'Cat updated successfully.');
        }

        return redirect()
            ->route('admin.cats.index')
            ->with('success', 'Cat updated successfully.');
    }

    public function destroy(int $id)
    {
        $this->cats->delete($id);

        return redirect()
            ->route('admin.cats.index')
            ->with('success', 'Cat deleted successfully.');
    }
}
