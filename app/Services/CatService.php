<?php

namespace App\Services;

use App\Repositories\CatRepository;
use App\Models\Cat;
use Illuminate\Support\Facades\Storage;


class CatService
{
    protected CatRepository $cats;

    public function __construct(CatRepository $cats)
    {
        $this->cats = $cats;
    }

    public function all(
        array $fields = ['*'],
        array $filters = [],
        array $with = [],
        array $orderBy = []
    ) {
        return $this->cats->all($fields, $filters, $with, $orderBy);
    }

    /**
     * Paginate cats
     */
    public function paginate(
        int $perPage = 15,
        array $fields = ['*'],
        array $filters = [],
        array $with = [],
        array $orderBy = []
    ) {
        return $this->cats->paginate($perPage, $fields, $filters, $with, $orderBy);
    }

    /**
     * Search cats (returns collection)
     */
    public function search(
        string $term,
        array $fields = ['*'],
        array $with = [],
        bool $includeDes = false,
        string $boolean = 'or',
        array $orderBy = []
    ) {
        return $this->cats->search($term, $fields, $with, $includeDes, $boolean, $orderBy);
    }

    /**
     * Search cats with pagination
     */
    public function searchPaginated(
        string $term,
        int $perPage = 15,
        array $fields = ['*'],
        array $with = [],
        bool $includeDes = false,
        string $boolean = 'or',
        array $orderBy = []
    ) {
        return $this->cats->searchPaginated($term, $perPage, $fields, $with, $includeDes, $boolean, $orderBy);
    }


    public function find(int $id, array $fields = ['*'], array $with = [])
    {
        return $this->cats->find($id, $fields, $with);
    }

    public function nameExists(string $name, ?int $ignoreId = null): bool
    {
        return $this->cats->existsByName($name, $ignoreId);
    }

    public function searchByName(
        string $term,
        array $fields = ['id', 'name'],
        array $orderBy = ['name' => 'asc'] // default
    ) {
        return $this->cats->searchByName(
            $term,
            $fields,
            [],        // no relations by default
            $orderBy   // pass dynamic orderBy to repository
        );
    }





    public function create(array $data): Cat
    {
        return $this->cats->create($data);
    }

    public function update(int $id, array $data): Cat
    {
        return $this->cats->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return (bool) $this->cats->delete($id);
    }

    public function deleteMany(array $ids): int
    {
        return $this->cats->deleteMany($ids);
    }

    /*
    protected function storeFile($file): string
    {
        return $file->store('cats', 'public');
    }


    protected function generateThumbnail(string $imgPath): string
    {
        // Example: append "_thumb" before extension
        $ext = pathinfo($imgPath, PATHINFO_EXTENSION);
        $base = basename($imgPath, ".".$ext);
        $dir  = dirname($imgPath);

        return $dir.'/'.$base.'_thumb.'.$ext;
    }
        */
}
