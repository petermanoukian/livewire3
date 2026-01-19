<?php
namespace App\Repositories;

use App\Models\Subcat;
use App\Models\Cat;

class SubcatRepository
{

    public function all(
        array $fields = ['*'],
        array $filters = [],
        array $with = [],
        array $orderBy = []
    ) {
        $query = Subcat::select($fields);

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
            $query = Subcat::select($fields);

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
        $query = Subcat::select($fields);

        if ($with) {
            $query->with($with);
        }

        $query->where(function ($q) use ($term, $includeDes, $boolean) {
            if (is_numeric($term)) {
                // exact match on ID if numeric
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
        $query = Subcat::select($fields);

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
        $query = Subcat::select($fields);

        if ($with) {
            $query->with($with);
        }

        return $query->findOrFail($id);
    }

    public function existsByName(string $name, int $catid, ?int $ignoreId = null): bool
    {
        $query = Subcat::where('name', $name)
                       ->where('catid', $catid);

        if ($ignoreId) {
            $query->where('id', '!=', $ignoreId);
        }

        return $query->exists();
    }


    public function getParentCat(int $catid, array $fields = ['*'], array $with = [])
    {
        $query = Cat::select($fields);

        if ($with) {
            $query->with($with);
        }

        return $query->findOrFail($catid);
    }



    public function getByCatId(int $catid, array $fields = ['*'], array $with = [])
    {
        $query = Subcat::select($fields)->where('catid', $catid);

        if ($with) {
            $query->with($with);
        }

        return $query->get();
    }

    public function searchByName(
        string $search,
        int $limit = 50,
        array $fields = ['*']
    ) {
        return Cat::select($fields)
            ->where('name', 'LIKE', '%' . $search . '%')
            ->orderBy('name')
            ->limit($limit)
            ->get();
    }




    public function create(array $data)
    {
        return Subcat::create($data);
    }

    public function update(int $id, array $data)
    {
        $subcat = Subcat::findOrFail($id);
        $subcat->update($data);
        return $subcat;
    }

    public function delete(int $id)
    {
        return Subcat::destroy($id);
    }

    public function deleteMany(array $ids)
    {
        return Subcat::destroy($ids);
    }

}
