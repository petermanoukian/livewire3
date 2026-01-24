<?php

namespace App\Repositories;

use App\Models\Prod;
use App\Models\Cat;
use App\Models\Subcat;

class ProdRepository
{
    public function all(
        array $fields = ['*'],
        array $filters = [],
        array $with = [],
        array $orderBy = []
    ) {
        $query = Prod::select($fields);

        if ($with) {
            $query->with($with);
        }

        foreach ($filters as $field => $value) {
            if (is_string($value)) {
                $query->where($field, 'like', "%{$value}%");
            } else {
                $query->where($field, $value);
            }
        }

        foreach ($orderBy as $column => $direction) {
            $query->orderBy($column, $direction);
        }

        return $query->get();
    }

    public function paginate(
        int $perPage = 15,
        array $fields = ['*'],
        array $filters = [],
        array $with = [],
        array $orderBy = []
    ) {
        $query = Prod::select($fields);

        if ($with) {
            $query->with($with);
        }

        foreach ($filters as $field => $value) {
            if (is_string($value)) {
                $query->where($field, 'like', "%{$value}%");
            } else {
                $query->where($field, $value);
            }
        }

        foreach ($orderBy as $column => $direction) {
            $query->orderBy($column, $direction);
        }

        return $query->paginate($perPage);
    }

    public function search(
        string $term,
        array $fields = ['*'],
        array $with = [],
        bool $includeDes = false,
        string $boolean = 'or',
        array $orderBy = []
    ) {
        $query = Prod::select($fields);

        if ($with) {
            $query->with($with);
        }

        $query->where(function ($q) use ($term, $includeDes, $boolean) {
            if (is_numeric($term)) {
                $q->where('id', (int) $term);
            } else {
                $q->where('name', 'like', "%{$term}%");

                if ($includeDes) {
                    strtolower($boolean) === 'and'
                        ? $q->where('des', 'like', "%{$term}%")
                        : $q->orWhere('des', 'like', "%{$term}%");
                }
            }
        });

        foreach ($orderBy as $column => $direction) {
            $query->orderBy($column, $direction);
        }

        return $query->get();
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
        $query = Prod::select($fields);

        if ($with) {
            $query->with($with);
        }

        $query->where(function ($q) use ($term, $includeDes, $boolean) {
            if (is_numeric($term)) {
                $q->where('id', (int) $term);
            } else {
                $q->where('name', 'like', "%{$term}%");

                if ($includeDes) {
                    strtolower($boolean) === 'and'
                        ? $q->where('des', 'like', "%{$term}%")
                        : $q->orWhere('des', 'like', "%{$term}%");
                }
            }
        });

        foreach ($orderBy as $column => $direction) {
            $query->orderBy($column, $direction);
        }

        return $query->paginate($perPage);
    }

    public function find(int $id, array $fields = ['*'], array $with = [])
    {
        $query = Prod::select($fields);

        if ($with) {
            $query->with($with);
        }

        return $query->findOrFail($id);
    }

    public function existsByName(string $name, int $catid, int $subcatid, ?int $ignoreId = null): bool
    {
        $query = Prod::where('name', $name)
                     ->where('catid', $catid)
                     ->where('subcatid', $subcatid);

        if ($ignoreId) {
            $query->where('id', '!=', $ignoreId);
        }

        return $query->exists();
    }

    public function getByCatId(int $catid, array $fields = ['*'], array $with = [])
    {
        $query = Prod::select($fields)->where('catid', $catid);

        if ($with) {
            $query->with($with);
        }

        return $query->get();
    }

    public function getBySubcatId(int $subcatid, array $fields = ['*'], array $with = [])
    {
        $query = Prod::select($fields)->where('subcatid', $subcatid);

        if ($with) {
            $query->with($with);
        }

        return $query->get();
    }

    public function create(array $data)
    {
        return Prod::create($data);
    }

    public function update(int $id, array $data)
    {
        $prod = Prod::findOrFail($id);
        $prod->update($data);
        return $prod;
    }

    public function delete(int $id)
    {
        return Prod::destroy($id);
    }

    public function deleteMany(array $ids)
    {
        return Prod::destroy($ids);
    }
}
