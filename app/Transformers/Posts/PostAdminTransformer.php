<?php

namespace App\Transformers\Posts;


use App\Models\Posts\Post;
use Illuminate\Support\Facades\Auth;
use League\Fractal\TransformerAbstract;

class PostAdminTransformer extends TransformerAbstract
{
    public function transform(Post $post)
    {
        $auth = Auth::user();

        return [
            'id' => (int)$post->id,
            'title' => $post->title,
            'excerpt' => $post->excerpt,
            'slug' => $post->slug,
            'user_name' => $post->user_name,
            'hits' => $post->hits,
            'j_published_at' => (string)$post->j_published_at,
            'j_expired_at' => (string)$post->j_expired_at,
            'state_name' => $post->state_name,
            'status_name' => $post->status_name,
            'category_title' => $post->category_title,
            'actions' => $this->getActions($auth, $post),
        ];
    }

    public function getActions($auth, $item)
    {
        $actions = "";

        if ($auth->can('adminPostsShow', $item)) {
            $actions .= '<a href="' . route('admin.posts.show', $item) . '" class="btn btn-block btn-xs btn-light-azure" data-toggle="tooltip" data-placement="left" title="' . trans('admin.default.actions.show') . '">'
                . '<i class="fa fa-eye"></i> ' . trans('admin.default.actions.show')
                . '</a>';
        }

        if ($auth->can('adminPostsEdit', $item)) {
            $actions .= '<a href="' . route('admin.posts.edit', $item) . '" class="btn btn-block btn-xs btn-dark-purple" data-toggle="tooltip" data-placement="left" title="' . trans('admin.default.actions.edit') . '">'
                . '<i class="fa fa-pencil"></i> ' . trans('admin.default.actions.edit')
                . '</a>';
        }

        return $actions;
    }
}