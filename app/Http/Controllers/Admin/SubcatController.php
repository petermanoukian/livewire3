<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubcatRequest;
use App\Services\SubcatService;
use App\Services\ImageUploadService;
use App\Services\FileUploaderService;
use Illuminate\Http\Request;

class SubcatController extends Controller
{
    protected SubcatService $subcats;
    protected ImageUploadService $imageUploadService;
    protected FileUploaderService $fileUploaderService;

    public function __construct(
        SubcatService $subcats,
        ImageUploadService $imageUploadService,
        FileUploaderService $fileUploaderService
    ) {
        $this->subcats = $subcats;
        $this->imageUploadService = $imageUploadService;
        $this->fileUploaderService = $fileUploaderService;
    }



    public function index(Request $request, string $catid = null)
    {
        return view('admin.subcats.index', [
            'request' => $request,
            'catid'   => $catid,
        ]);
    }



}