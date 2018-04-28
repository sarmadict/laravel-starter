<?php

namespace App\Models\Posts;

use App\Models\BaseModel;
use App\Models\Traits\HasState;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends BaseModel
{
    use SoftDeletes, HasState, PostRelationships, PostScopes, PostModifiers;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'slug', 'excerpt', 'content', 'user_id', 'user_name', 'status',
        'category_id', 'published_at', 'expired_at', 'image_path', 'hits',
        'meta_keywords', 'meta_description', 'state', 'created_by', 'updated_by'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'meta_keywords' => 'array',
    ];

    /**
     * Create a new Eloquent model instance.
     *
     * @param  array $attributes
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(config('tables.posts'));
    }
}
