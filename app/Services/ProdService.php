<?php

namespace App\Services;

use App\Repositories\ProdRepository;
use App\Models\Prod;

class ProdService
{
    protected ProdRepository $prods;

    public function __construct(ProdRepository $prods)
    {
        $this->prods = $prods;
    }

    public function all(
        array $fields = ['*'],
        array $filters = [],
        array $with = [],
        array $orderBy = []
    ) {
        return $this->prods->all($fields, $filters, $with, $orderBy);
    }

    public function paginate(
        int $perPage = 15,
        array $fields = ['*'],
        array $filters = [],
        array $with = [],
        array $orderBy = []
    ) {
        return $this->prods->paginate($perPage, $fields, $filters, $with, $orderBy);
    }

    public function search(
        string $term,
        array $fields = ['*'],
        array $with = [],
        bool $includeDes = false,
        string $boolean = 'or',
        array $orderBy = []
    ) {
        return $this->prods->search($term, $fields, $with, $includeDes, $boolean, $orderBy);
    }

    public function searchPaginated(
        string $term,
        int $perPage = 15,
        array $fields = ['*'],
        array $with = [],
        bool $includeDes = false,
        string $boolean = 'or',
        array $orderBy = []
    ) {
        return $this->prods->searchPaginated($term, $perPage, $fields, $with, $includeDes, $boolean, $orderBy);
    }

    public function find(int $id, array $fields = ['*'], array $with = [])
    {
        return $this->prods->find($id, $fields, $with);
    }

    public function nameExists(string $name, int $catid, int $subcatid, ?int $ignoreId = null): bool
    {
        return $this->prods->existsByName($name, $catid, $subcatid, $ignoreId);
    }

    public function create(array $data): Prod
    {
        return $this->prods->create($data);
    }

    public function update(int $id, array $data): Prod
    {
        return $this->prods->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return (bool) $this->prods->delete($id);
    }

    public function deleteMany(array $ids): int
    {
        return $this->prods->deleteMany($ids);
    }

    public function getByCatId(int $catid, array $fields = ['*'], array $with = [])
    {
        return $this->prods->getByCatId($catid, $fields, $with);
    }

    public function getBySubcatId(int $subcatid, array $fields = ['*'], array $with = [])
    {
        return $this->prods->getBySubcatId($subcatid, $fields, $with);
    }
}
