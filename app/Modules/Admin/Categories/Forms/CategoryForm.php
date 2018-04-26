<?php

namespace App\Modules\Admin\Categories\Forms;


use App\Http\Forms\Admin\AdminBaseForm;
use App\Models\Categories\Category;

class CategoryForm extends AdminBaseForm
{
    public function buildForm()
    {
        parent::buildForm();

        $this->add('name', 'text', [
            'label' => trans('admin.categories.fields.name'),
            'label_attr' => [
                'class' => 'col-md-3 control-label',
            ],
            'attr' => [
                'placeholder' => trans('admin.categories.elements.name'),
            ],
            'widget_prefix' => '<div class="col-md-9">',
            'widget_suffix' => '</div>',
        ]);

        $this->add('title', 'text', [
            'label' => trans('admin.categories.fields.title'),
            'label_attr' => [
                'class' => 'col-md-3 control-label',
            ],
            'attr' => [
                'placeholder' => trans('admin.categories.elements.title'),
            ],
            'widget_prefix' => '<div class="col-md-9">',
            'widget_suffix' => '</div>',
        ]);

        $this->add('slug', 'text', [
            'label' => trans('admin.categories.fields.slug'),
            'label_attr' => [
                'class' => 'col-md-3 control-label',
            ],
            'attr' => [
                'placeholder' => trans('admin.categories.elements.slug'),
            ],
            'widget_prefix' => '<div class="col-md-9">',
            'widget_suffix' => '</div>',
        ]);

        $this->add('keywords', 'choice', [
            'label' => trans('admin.categories.fields.keywords'),
            'label_attr' => [
                'class' => 'control-label',
            ],
            'attr' => [
                'class' => 'form-control col-md-12 select2 select2-tags',
            ],
            'multiple' => true,
            'choices' => $this->getKeywords(),
        ]);

        $this->add('description', 'textarea', [
            'label' => trans('admin.categories.fields.description'),
            'label_attr' => [
                'class' => 'col-md-3 control-label',
            ],
            'attr' => [
                'class' => 'form-control area-animated',
                'placeholder' => trans('admin.categories.elements.description'),
            ],
            'widget_prefix' => '<div class="col-md-9"><div class="note-editor">',
            'widget_suffix' => '</div></div>',
        ]);

        $this->add('parent_id', 'choice', [
            'label' => trans('admin.categories.fields.parent_id'),
            'label_attr' => [
                'class' => 'control-label',
            ],
            'attr' => [
                'class' => 'form-control col-md-12 select2 select2-regular',
            ],
            'choices' => $this->getParentIds()
        ]);
    }

    protected function getParentIds()
    {
        $type = $this->getData('type');

        return Category::query()->ofType($type)->pluck('title', 'id')->toArray();
    }

    protected function getKeywords()
    {
        $model = $this->getModel();

        $items = old('keywords', $model ? $model->keywords : []);

        return array_combine($items, $items);
    }
}