<?php

namespace App\Models\Categories;


use App\Models\NestedSetModel;
use App\Models\Traits\HasCreatorAndUpdater;
use App\Models\Traits\HasJalaliTimestamps;
use App\Models\Traits\HasState;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends NestedSetModel
{
    use SoftDeletes, CategoryRelationships, CategoryScopes, CategoryModifiers,
        HasState, HasJalaliTimestamps, HasCreatorAndUpdater;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'title', 'description', 'slug', 'type', 'hits', 'keywords', 'state', 'created_by', 'updated_by'
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
