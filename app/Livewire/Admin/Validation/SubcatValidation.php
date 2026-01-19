<?php

namespace App\Livewire\Admin\Validation;

class SubcatValidation
{
    public static function rulesCreate(?int $catid = null): array
    {
        return [
            'catid'  => ['required', 'integer', 'exists:cats,id'],
            'name'   => ['required', 'string', 'max:255', 'unique:subcats,name,NULL,id,catid,' . $catid],
            'des'    => ['nullable', 'string', 'max:500'],
            'dess'   => ['nullable', 'string', 'max:500'],
            'img'    => ['nullable', 'image', 'max:55120'],
            'filer'  => ['nullable', 'file', 'max:59200'],
        ];
    }

    public static function rulesUpdate(int $id, int $catid= null): array
    {
        return [
            'catid'  => ['required', 'integer', 'exists:cats,id'],
            'name'   => ['required', 'string', 'max:255', 'unique:subcats,name,' . $id . ',id,catid,' . $catid],
            'des'    => ['nullable', 'string', 'max:500'],
            'dess'   => ['nullable', 'string', 'max:500'],
            'img'    => ['nullable', 'image', 'max:55120'],
            'filer'  => ['nullable', 'file', 'max:59200'],
        ];
    }

    public static function messages(): array
    {
        return [
            'catid.required' => 'A parent category is required.',
            'catid.exists'   => 'The selected category does not exist.',
            'name.required'  => 'A subcategory name is required.',
            'name.unique'    => 'This subcategory name already exists in the selected category.',
            'name.max'       => 'Subcategory name must not exceed 255 characters.',
            'des.max'        => 'Description must not exceed 500 characters.',
            'dess.max'       => 'Secondary description must not exceed 500 characters.',
            'img.image'      => 'The uploaded image must be valid.',
            'img.max'        => 'The image size exceeds the allowed limit.',
            'filer.file'     => 'The uploaded file must be valid.',
            'filer.max'      => 'The file size exceeds the allowed limit.',
        ];
    }
}
