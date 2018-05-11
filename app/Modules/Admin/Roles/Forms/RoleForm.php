<?php

namespace App\Modules\Admin\Roles\Forms;


use App\Http\Forms\Admin\AdminBaseForm;
use App\Models\Permissions\Permission;

class RoleForm extends AdminBaseForm
{
    public function buildForm()
    {
        parent::buildForm();

        $this->add('name', 'text', [
            'label' => trans('admin.roles.fields.name'),
            'label_attr' => [
                'class' => 'col-md-3 control-label',
            ],
            'attr' => [
                'placeholder' => trans('admin.roles.elements.name'),
            ],
            'widget_prefix' => '<div class="col-md-9">',
            'widget_suffix' => '</div>',
        ]);

        $this->add('title', 'text', [
            'label' => trans('admin.roles.fields.title'),
            'label_attr' => [
                'class' => 'col-md-3 control-label',
            ],
            'attr' => [
                'placeholder' => trans('admin.roles.elements.title'),
            ],
            'widget_prefix' => '<div class="col-md-9">',
            'widget_suffix' => '</div>',
        ]);

        $this->add('description', 'textarea', [
            'label' => trans('admin.roles.fields.description'),
            'label_attr' => [
                'class' => 'col-md-3 control-label',
            ],
            'attr' => [
                'class' => 'form-control area-animated',
                'placeholder' => trans('admin.roles.elements.description'),
            ],
            'widget_prefix' => '<div class="col-md-9"><div class="note-editor">',
            'widget_suffix' => '</div></div>',
        ]);


        $this->add('created_at', 'static', [
            'label' => trans('admin.users.fields.created_at'),
            'label_attr' => [
                'class' => 'control-label col-md-8',
            ],
            'attr' => [
                'class' => 'form-control-static',
            ],
            'widget_prefix' => '<div class="col-md-4">',
            'widget_suffix' => '</div>',
        ]);

        $this->add('updated_at', 'static', [
            'label' => trans('admin.users.fields.updated_at'),
            'label_attr' => [
                'class' => 'control-label col-md-8',
            ],
            'attr' => [
                'class' => 'form-control-static',
            ],
            'widget_prefix' => '<div class="col-md-4">',
            'widget_suffix' => '</div>',
        ]);

        $this->add('created_by', 'static', [
            'label' => trans('admin.users.fields.created_by'),
            'label_attr' => [
                'class' => 'control-label col-md-8',
            ],
            'attr' => [
                'class' => 'form-control-static',
            ],
            'widget_prefix' => '<div class="col-md-4">',
            'widget_suffix' => '</div>',
            'value' => $this->getCreatedByName(),
        ]);

        $this->add('updated_by', 'static', [
            'label' => trans('admin.users.fields.updated_by'),
            'label_attr' => [
                'class' => 'control-label col-md-8',
            ],
            'attr' => [
                'class' => 'form-control-static',
            ],
            'widget_prefix' => '<div class="col-md-4">',
            'widget_suffix' => '</div>',
            'value' => $this->getUpdatedByName(),
        ]);

        $this->add('permissions', 'choice', [
            'label' => false,
            'choice_options' => [
                'label_attr' => [
                    'class' => '',
                ],
                'wrapper' => [
                    'class' => 'col-md-3 checkbox clip-check check-primary checkbox-inline',
                ],
            ],
            'selected' => $this->getSelectedPermissions(),
            'choices' => $this->getPermissions(),
            'expanded' => true,
            'multiple' => true,
        ]);
    }

    protected function getCreatedByName()
    {
        $model = $this->getModel();

        return ($model && $model->creator) ? $model->creator->display_name : '';
    }

    protected function getUpdatedByName()
    {
        $model = $this->getModel();

        return ($model && $model->updater) ? $model->updater->display_name : '';
    }

    protected function getPermissions()
    {
        return Permission::query()->enabled()->pluck('title', 'id')->toArray();
    }

    protected function getSelectedPermissions()
    {
        $model = $this->getModel();

        return $model ? $model->permissions()->pluck('id')->toArray() : [];
    }
}