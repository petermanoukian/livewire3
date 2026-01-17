<?php

namespace App\Services\Livewire;

use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Log;

class LivewireImageUploadService
{
    public function upload(
        TemporaryUploadedFile $file,
        string $largeFolder,
        string $smallFolder,
        int $maxWidth = 1500,
        int $maxHeight = 1000,
        ?string $baseFileName = null,
        int $thumbWidth = 200,
        int $thumbHeight = 200
    ): ?array {
        if (!$file) {
            Log::warning('🚫 No image received');
            return null;
        }

        $originalName = $file->getClientOriginalName();
        $extension    = strtolower($file->getClientOriginalExtension());

        $baseFileName = $baseFileName ?: pathinfo($originalName, PATHINFO_FILENAME);
        $baseFileName = str_replace([' ', '/'], '-', $baseFileName);

        $suffix = time() . '_' . uniqid();
        $fileName = "{$baseFileName}-{$suffix}.{$extension}";

        $largePath = public_path("{$largeFolder}/{$fileName}");
        $smallPath = public_path("{$smallFolder}/{$fileName}");

        $largeDir = dirname($largePath);
        $smallDir = dirname($smallPath);

        if (!is_dir($largeDir)) {
            mkdir($largeDir, 0755, true);
        }

        if (!is_dir($smallDir)) {
            mkdir($smallDir, 0755, true);
        }

        $manager = new ImageManager(new Driver());

        $image = $manager->read($file->getRealPath());
        $image->resize($maxWidth, $maxHeight, fn ($c) => $c->aspectRatio()->upsize());
        $image->save($largePath);

        $manager->read($file->getRealPath())
            ->cover($thumbWidth, $thumbHeight)
            ->save($smallPath);

        return [
            'large' => "{$largeFolder}/{$fileName}",
            'small' => "{$smallFolder}/{$fileName}",
            'original_name' => $originalName,
        ];
    }
}
