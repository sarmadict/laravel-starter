<?php

namespace App\Repositories\Posts;


use App\Models\Categories\Category;
use App\Models\Posts\Post;
use App\Repositories\Repository;
use App\Types\State;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostRepository extends Repository
{
    public function __construct(Post $model)
    {
        $this->setModel($model);
    }

    public function getAdminDatatable()
    {
        $query = $this->query()->with(['category', 'user']);

        return $query;
    }

    public function getCategory($id)
    {
        return $id ? Category::query()->find($id) : null;
    }

    public function createPost($data)
    {
        $category = $this->getCategory(array_get($data, 'category_id', null));

        $auth = Auth::user();

        $item = $this->forceCreate([
            'title' => $data['title'],
            'excerpt' => array_get($data, 'excerpt', null),
            'content' => $data['content'],
            'category_id' => $category ? $category->id : null,
            'user_id' => array_get($data, 'user_id'),
            'user_name' => array_get($data, 'user_name', null),
            'slug' => array_get($data, 'slug'),
            'image_path' => array_get($data, 'image_path', ''),
            'status' => array_get($data, 'status'),
            'published_at' => array_get($data, 'published_at'),
            'expired_at' => array_get($data, 'expired_at'),
            'meta_keywords' => array_get($data, 'meta_keywords', []),
            'meta_description' => array_get($data, 'meta_description', []),
            'state' => array_has($data, 'state') ? State::ENABLED : State::DISABLED,
            'created_by' => $auth->id,
            'updated_by' => $auth->id,
        ]);

        return $item;
    }

    public function updatePost($item, $data)
    {
        $category = $this->getCategory(array_get($data, 'category_id', null));

        $auth = Auth::user();

        $item = $this->forceUpdate($item, [
            'title' => $data['title'],
            'excerpt' => array_get($data, 'excerpt', null),
            'content' => $data['content'],
            'category_id' => $category ? $category->id : null,
            'user_id' => array_get($data, 'user_id'),
            'user_name' => array_get($data, 'user_name', null),
            'slug' => array_get($data, 'slug'),
            'image_path' => array_get($data, 'image_path', ''),
            'status' => array_get($data, 'status'),
            'published_at' => array_get($data, 'published_at'),
            'expired_at' => array_get($data, 'expired_at'),
            'meta_keywords' => array_get($data, 'meta_keywords', []),
            'meta_description' => array_get($data, 'meta_description', []),
            'state' => array_has($data, 'state') ? State::ENABLED : State::DISABLED,
            'updated_by' => $auth->id,
        ]);

        return $item;
    }
}