<?php
namespace App\Repositories;

use App\Models\Cat;

class CatRepository
{
    /**
     * Get all records
     */
    public function all(
        array $fields = ['*'],
        array $filters = [],
        array $with = [],
        array $orderBy = []
    ) {
        $query = Cat::select($fields);

        if ($with) {
            $query->with($with);
        }

        // INLINE FILTERS
        foreach ($filters as $field => $value) {
            if (is_string($value)) {
                $query->where($field, 'like', "%{$value}%");
            } else {
                $query->where($field, $value);
            }
        }

        // INLINE ORDER
        foreach ($orderBy as $column => $direction) {
            $query->orderBy($column, $direction);
        }

        return $query->get();
    }

    /**
     * Paginate results
     */
    public function paginate(
        int $perPage = 15,
        array $fields = ['*'],
        array $filters = [],
        array $with = [],
        array $orderBy = []
    ) {
        $query = Cat::select($fields);

        if ($with) {
            $query->with($with);
        }

        // INLINE FILTERS
        foreach ($filters as $field => $value) {
            if (is_string($value)) {
                $query->where($field, 'like', "%{$value}%");
            } else {
                $query->where($field, $value);
            }
        }

        // INLINE ORDER
        foreach ($orderBy as $column => $direction) {
            $query->orderBy($column, $direction);
        }

        return $query->paginate($perPage);
    }

    /**
     * Search (collection)
     */
    public function search(
        string $term,
        array $fields = ['*'],
        array $with = [],
        bool $includeDes = false,
        string $boolean = 'or',
        array $orderBy = []
    ) {
        $query = Cat::select($fields);

        if ($with) {
            $query->with($with);
        }

        $query->where(function ($q) use ($term, $includeDes, $boolean) {
            $q->where('name', 'like', "%{$term}%");

            if ($includeDes) {
                strtolower($boolean) === 'and'
                    ? $q->where('des', 'like', "%{$term}%")
                    : $q->orWhere('des', 'like', "%{$term}%");
            }
        });

        // INLINE ORDER
        foreach ($orderBy as $column => $direction) {
            $query->orderBy($column, $direction);
        }

        return $query->get();
    }

    /**
     * Search with pagination
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
        $query = Cat::select($fields);

        if ($with) {
            $query->with($with);
        }

        $query->where(function ($q) use ($term, $includeDes, $boolean) {
            $q->where('name', 'like', "%{$term}%");

            if ($includeDes) {
                strtolower($boolean) === 'and'
                    ? $q->where('des', 'like', "%{$term}%")
                    : $q->orWhere('des', 'like', "%{$term}%");
            }
        });

        // INLINE ORDER
        foreach ($orderBy as $column => $direction) {
            $query->orderBy($column, $direction);
        }

        return $query->paginate($perPage);
    }

    public function find(int $id, array $fields = ['*'], array $with = [])
    {
        $query = Cat::select($fields);

        if ($with) {
            $query->with($with);
        }

        return $query->findOrFail($id);
    }

    public function existsByName(string $name, ?int $ignoreId = null): bool
    {
        $query = Cat::where('name', $name);

        if ($ignoreId) {
            $query->where('id', '!=', $ignoreId);
        }

        return $query->exists();
    }


    public function create(array $data)
    {
        return Cat::create($data);
    }

    public function update(int $id, array $data)
    {
        $cat = Cat::findOrFail($id);
        $cat->update($data);
        return $cat;
    }

    public function delete(int $id)
    {
        return Cat::destroy($id);
    }

    public function deleteMany(array $ids)
    {
        return Cat::destroy($ids);
    }
}
