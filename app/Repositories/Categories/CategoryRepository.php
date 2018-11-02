<?php

namespace App\Repositories\Categories;


use App\Models\Categories\Category;
use App\Repositories\Repository;
use App\Types\General\Category as CategoryType;
use App\Types\State;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoryRepository extends Repository
{
    public function __construct(Category $model)
    {
        $this->setModel($model);
    }

    public function getAdminDatatable()
    {
        $query = $this->query()->with(['parent']);

        return $query;
    }

    public function createRootCategory($typeId)
    {
        $type = new CategoryType($typeId);

        return $this->forceCreate([
            'name' => 'root_' . $type->getKey(),
            'title' => 'Root ' . $type->getKey(),
            'slug' => 'root_' . $type->getKey(),
            'type' => $type,
            'state' => State::ENABLED,
        ]);
    }

    public function getRootCategory($type)
    {
        $root = $this->roots()->ofType($type)->first();

        return $root ?: $this->createRootCategory($type);
    }

    public function getParentCategory($id, $type)
    {
        return $id ? $this->findOrFail($id) : $this->getRootCategory($type);
    }

    public function createCategory($data, $type)
    {
        DB::beginTransaction();

        $parent = $this->getParentCategory(array_get($data, 'parent_id', null), (int)$type);

        $auth = Auth::user();

        $item = $this->forceCreate([
            'name' => $data['name'],
            'title' => $data['title'],
            'description' => $data['description'],
            'type' => $type,
            'slug' => array_get($data, 'slug', null),
            'keywords' => array_get($data, 'keywords', []),
            'state' => array_has($data, 'state') ? State::ENABLED : State::DISABLED,
            'created_by' => $auth->id,
            'updated_by' => $auth->id,
        ]);

        $item->makeChildOf($parent);

        DB::commit();

        return $item;
    }

    public function updateCategory($item, $data)
    {
        DB::beginTransaction();

        $parent = $this->getParentCategory(array_get($data, 'parent_id', $item->parent_id), $item->type->getValue());

        $auth = Auth::user();

        $item = $this->forceUpdate($item, [
            'name' => $data['name'],
            'title' => $data['title'],
            'description' => $data['description'],
            'slug' => array_get($data, 'slug', null),
            'keywords' => array_get($data, 'keywords', []),
            'state' => array_has($data, 'state') ? State::ENABLED : State::DISABLED,
            'updated_by' => $auth->id,
        ]);

        $item->makeChildOf($parent);

        DB::commit();

        return $item;
    }
}