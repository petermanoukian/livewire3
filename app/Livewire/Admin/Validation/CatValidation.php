<?php

namespace App\Livewire\Admin\Validation;

class CatValidation
{
    public static function rulesCreate(): array
    {
        return [
            'name'   => ['required', 'string', 'max:255', 'unique:cats,name'],
            'des'    => ['nullable', 'string', 'max:500'],
            'dess'   => ['nullable', 'string', 'max:500'],
            'img'    => ['nullable', 'image', 'max:55120'],
            'filer'  => ['nullable', 'file', 'max:59200'],
        ];
    }

    public static function rulesUpdate(int $id): array
    {
        return [
            'name'   => ['required', 'string', 'max:255', 'unique:cats,name,' . $id],
            'des'    => ['nullable', 'string', 'max:500'],
            'dess'   => ['nullable', 'string', 'max:500'],
            'img'    => ['nullable', 'image', 'max:55120'],
            'filer'  => ['nullable', 'file', 'max:59200'],
        ];
    }

    public static function messages(): array
    {
        return [
            'name.required' => 'A cat name is required.',
            'name.unique'   => 'This cat name already exists.',
            'name.max'      => 'Cat name must not exceed 255 characters.',
            'des.max'       => 'Description must not exceed 500 characters.',
            'dess.max'      => 'Secondary description must not exceed 500 characters.',
            'img.image'     => 'The uploaded image must be valid.',
            'img.max'       => 'The image size exceeds the allowed limit.',
            'filer.file'    => 'The uploaded file must be valid.',
            'filer.max'     => 'The file size exceeds the allowed limit.',
        ];
    }
}
