<?php

namespace App\Services;

use App\Repositories\SubcatRepository;
use App\Models\Subcat;

class SubcatService
{
    protected SubcatRepository $subcats;

    public function __construct(SubcatRepository $subcats)
    {
        $this->subcats = $subcats;
    }

    public function all(
        array $fields = ['*'],
        array $filters = [],
        array $with = [],
        array $orderBy = []
    ) {
        return $this->subcats->all($fields, $filters, $with, $orderBy);
    }


    public function paginate(
        int $perPage = 15,
        array $fields = ['*'],
        array $filters = [],
        array $with = [],
        array $orderBy = []
    ) {
        return $this->subcats->paginate($perPage, $fields, $filters, $with, $orderBy);
    }


    public function search(
        string $term,
        array $fields = ['*'],
        array $with = [],
        bool $includeDes = false,
        string $boolean = 'or',
        array $orderBy = []
    ) {
        return $this->subcats->search($term, $fields, $with, $includeDes, $boolean, $orderBy);
    }



    public function searchByName(
        string $search,
        int $limit = 50,
        array $fields = ['id', 'name']
    ) {
        return $this->repository->searchByName(
            $search,
            $limit,
            $fields
        );
    }

    public function searchByCatIdAndName(
        int $catid,
        string $search,
        array $fields = ['id', 'name'],
        array $orderBy = ['name' => 'asc']
    ) {
        return $this->subcats->searchByCatIdAndName($catid, $search, $fields, $orderBy);
    }


    /**
     * Search subcats with pagination
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
        return $this->subcats->searchPaginated($term, $perPage, $fields, $with, $includeDes, $boolean, $orderBy);
    }

    public function find(int $id, array $fields = ['*'], array $with = [])
    {
        return $this->subcats->find($id, $fields, $with);
    }

    public function nameExists(string $name, int $catid, ?int $ignoreId = null): bool
    {
        return $this->subcats->existsByName($name, $catid, $ignoreId);
    }

    public function create(array $data): Subcat
    {
        return $this->subcats->create($data);
    }

    public function update(int $id, array $data): Subcat
    {
        return $this->subcats->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return (bool) $this->subcats->delete($id);
    }

    public function deleteMany(array $ids): int
    {
        return $this->subcats->deleteMany($ids);
    }


    public function getParentCat(int $catid, array $fields = ['*'], array $with = [])
    {
        return $this->subcats->getParentCat($catid, $fields, $with);
    }


    public function getByCatId(int $catid, array $fields = ['*'], array $with = [])
    {
        return $this->subcats->getByCatId($catid, $fields, $with);
    }
}
