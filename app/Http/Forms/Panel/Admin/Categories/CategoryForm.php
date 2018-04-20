<?php

namespace App\Http\Forms\Panel\Admin\Categories;


use App\Http\Forms\Panel\Admin\AdminBaseForm;
use App\Models\Categories\Category;

class CategoryForm extends AdminBaseForm
{
    public function buildForm()
    {
        parent::buildForm();

        $this->add('name', 'text', [
            'label' => trans('panel.admin.categories.name'),
            'label_attr' => [
                'class' => 'col-md-3 control-label',
            ],
            'widget_prefix' => '<div class="col-md-9">',
            'widget_suffix' => '</div>',
        ]);

        $this->add('title', 'text', [
            'label' => trans('panel.admin.categories.title'),
            'label_attr' => [
                'class' => 'col-md-3 control-label',
            ],
            'widget_prefix' => '<div class="col-md-9">',
            'widget_suffix' => '</div>',
        ]);

        $this->add('slug', 'text', [
            'label' => trans('panel.admin.categories.slug'),
            'label_attr' => [
                'class' => 'col-md-3 control-label',
            ],
            'widget_prefix' => '<div class="col-md-9">',
            'widget_suffix' => '</div>',
        ]);

        $this->add('keywords', 'text', [
            'label' => trans('panel.admin.categories.keywords'),
            'label_attr' => [
                'class' => 'control-label',
            ],
        ]);

        $this->add('description', 'textarea', [
            'label' => trans('panel.admin.categories.description'),
            'label_attr' => [
                'class' => 'col-md-3 control-label',
            ],
            'widget_prefix' => '<div class="col-md-9">',
            'widget_suffix' => '</div>',
        ]);

        $this->add('parent_id', 'choice', [
            'label' => trans('panel.admin.categories.parent_id'),
            'label_attr' => [
                'class' => 'control-label',
            ],
            'choices' => $this->getParentIds()
        ]);
    }

    protected function getParentIds()
    {
        $type = $this->getData('type');

        return Category::query()->ofType($type)->pluck('title', 'id')->toArray();
    }

}