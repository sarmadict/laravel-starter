<?php

namespace App\Models\Categories;


use App\Models\NestedSetModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends NestedSetModel
{
    use SoftDeletes, CategoryRelationships, CategoryScopes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'title', 'description', 'slug', 'types', 'hits', 'keywords', 'state', 'created_by', 'updated_by'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'keywords' => 'array',
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

        $this->setTable(config('tables.categories'));
    }
}
