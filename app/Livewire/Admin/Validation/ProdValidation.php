<?php

namespace App\Livewire\Admin\Validation;

class ProdValidation
{
    public static function rulesCreate(?int $catid = null, ?int $subcatid = null): array
    {
        return [
            'catid'     => ['required', 'integer', 'exists:cats,id'],
            'subcatid'  => ['required', 'integer', 'exists:subcats,id'],
            'name'      => ['required', 'string', 'max:255',
                            'unique:prods,name,NULL,id,catid,' . $catid . ',subcatid,' . $subcatid],
            'des'       => ['nullable', 'string', 'max:500'],
            'dess'      => ['nullable', 'string', 'max:500'],
            'img'       => ['nullable', 'image', 'max:55120'],
            'filer'     => ['nullable', 'file', 'max:59200'],
        ];
    }

    public static function rulesUpdate(int $id, ?int $catid = null, ?int $subcatid = null): array
    {
        return [
            'catid'     => ['required', 'integer', 'exists:cats,id'],
            'subcatid'  => ['required', 'integer', 'exists:subcats,id'],
            'name'      => ['required', 'string', 'max:255',
                            'unique:prods,name,' . $id . ',id,catid,' . $catid . ',subcatid,' . $subcatid],
            'des'       => ['nullable', 'string', 'max:500'],
            'dess'      => ['nullable', 'string', 'max:500'],
            'img'       => ['nullable', 'image', 'max:55120'],
            'filer'     => ['nullable', 'file', 'max:59200'],
        ];
    }

    public static function messages(): array
    {
        return [
            'catid.required'    => 'A parent category is required.',
            'catid.exists'      => 'The selected category does not exist.',
            'subcatid.required' => 'A parent subcategory is required.',
            'subcatid.exists'   => 'The selected subcategory does not exist.',
            'name.required'     => 'A product name is required.',
            'name.unique'       => 'This product name already exists in the selected category/subcategory.',
            'name.max'          => 'Product name must not exceed 255 characters.',
            'des.max'           => 'Description must not exceed 500 characters.',
            'dess.max'          => 'Secondary description must not exceed 500 characters.',
            'img.image'         => 'The uploaded image must be valid.',
            'img.max'           => 'The image size exceeds the allowed limit.',
            'filer.file'        => 'The uploaded file must be valid.',
            'filer.max'         => 'The file size exceeds the allowed limit.',
        ];
    }
}
