<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CatRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        // Optional diagnostics
        // if ($this->hasFile('img')) \Log::info('IMG MIME: ' . $this->file('img')->getMimeType());
        // if ($this->hasFile('filer')) \Log::info('FILE MIME: ' . $this->file('filer')->getMimeType());
    }

    public function rules(): array
    {
        return [
            'name'   => ['required', 'string', 'max:255', 'unique:cats,name'],
            'des'    => ['nullable', 'string', 'max:500'],
            'dess'   => ['nullable', 'string', 'max:500'],

            // General file upload (documents + images)
            'filer' => [
                'nullable',
                'file',
                'max:51200', // ~50MB
                'mimetypes:application/pdf,
                           application/msword,
                           application/vnd.openxmlformats-officedocument.wordprocessingml.document,
                           application/vnd.ms-excel,
                           application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,
                           text/plain,
                           image/jpeg,
                           image/jpg,
                           image/png,
                           image/gif,
                           image/webp'
            ],

            // Dedicated image field
            'img' => [
                'nullable',
                'file',
                'max:25120', // ~5MB
                'mimetypes:image/jpeg,image/jpg,image/png,image/gif,image/webp'
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'A cat name is required.',
            'name.unique'   => 'This cat name already exists.',
            'name.max'      => 'Cat name must not exceed 255 characters.',

            'des.string'    => 'Description must be text.',
            'des.max'       => 'Description must not exceed 500 characters.',

            'dess.string'   => 'Secondary description must be text.',
            'dess.max'      => 'Secondary description must not exceed 500 characters.',

            'filer.file'      => 'The uploaded file must be valid.',
            'filer.max'       => 'The file size exceeds the allowed limit.',
            'filer.mimetypes' => 'The uploaded file type is not allowed.',

            'img.file'      => 'The uploaded image must be a valid file.',
            'img.max'       => 'The image size exceeds the allowed limit.',
            'img.mimetypes' => 'The uploaded image type is not allowed.',
        ];
    }
}
