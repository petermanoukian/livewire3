<?php

namespace App\Services\Livewire;

use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Illuminate\Support\Facades\Log;

class LivewireFileUploaderService
{
    public function prepare(
        TemporaryUploadedFile $file,
        string $folder,
        string $baseFileName,
        string $randomSuffix
    ): ?array {
        if (!$file) {
            Log::warning('🚫 No file received');
            return null;
        }

        $extension = strtolower($file->getClientOriginalExtension());
        $original  = $file->getClientOriginalName();

        $baseFileName = $baseFileName ?: pathinfo($original, PATHINFO_FILENAME);
        $baseFileName = str_replace([' ', '/'], '-', $baseFileName);

        $fileName = "{$baseFileName}_{$randomSuffix}.{$extension}";
        $relativePath = "{$folder}/{$fileName}";

        return [
            'file'      => $file,
            'path'      => $relativePath,
            'filename'  => $fileName,
            'original'  => $original,
            'extension' => $extension,
        ];
    }
}
