<?php

namespace App\Modules\Admin\Users\Forms;


use App\Http\Forms\Admin\AdminBaseForm;
use App\Models\Permissions\Permission;
use App\Models\Roles\Role;
use App\Models\Users\User;
use App\Types\Accounts\Gender;

class UserForm extends AdminBaseForm
{
    public function buildForm()
    {
        parent::buildForm();

        $this->add('first_name', 'text', [
            'label' => trans('admin.users.fields.first_name'),
            'label_attr' => [
                'class' => 'col-md-3 control-label',
            ],
            'attr' => [
                'placeholder' => trans('admin.users.elements.first_name'),
            ],
            'widget_prefix' => '<div class="col-md-9">',
            'widget_suffix' => '</div>',
        ]);

        $this->add('last_name', 'text', [
            'label' => trans('admin.users.fields.last_name'),
            'label_attr' => [
                'class' => 'col-md-3 control-label',
            ],
            'attr' => [
                'placeholder' => trans('admin.users.elements.last_name'),
            ],
            'widget_prefix' => '<div class="col-md-9">',
            'widget_suffix' => '</div>',
        ]);

        $this->add('display_name', 'text', [
            'label' => trans('admin.users.fields.display_name'),
            'label_attr' => [
                'class' => 'col-md-3 control-label',
            ],
            'attr' => [
                'placeholder' => trans('admin.users.elements.display_name'),
            ],
            'widget_prefix' => '<div class="col-md-9">',
            'widget_suffix' => '</div>',
        ]);

        $this->add('username', 'text', [
            'label' => trans('admin.users.fields.username'),
            'label_attr' => [
                'class' => 'col-md-3 control-label',
            ],
            'attr' => [
                'placeholder' => trans('admin.users.elements.username'),
            ],
            'widget_prefix' => '<div class="col-md-9">',
            'widget_suffix' => '</div>',
        ]);

        $this->add('email', 'text', [
            'label' => trans('admin.users.fields.email'),
            'label_attr' => [
                'class' => 'col-md-3 control-label',
            ],
            'attr' => [
                'placeholder' => trans('admin.users.elements.email'),
                'class' => 'form-control  dir-ltr'
            ],
            'widget_prefix' => '<div class="col-md-9">',
            'widget_suffix' => '</div>',
        ]);

        $this->add('mobile_number', 'text', [
            'label' => trans('admin.users.fields.mobile_number'),
            'label_attr' => [
                'class' => 'col-md-3 control-label',
            ],
            'attr' => [
                'placeholder' => trans('admin.users.elements.mobile_number'),
                'class' => 'form-control  dir-ltr'
            ],
            'widget_prefix' => '<div class="col-md-9">',
            'widget_suffix' => '</div>',
        ]);

        $this->add('position', 'text', [
            'label' => trans('admin.users.fields.position'),
            'label_attr' => [
                'class' => 'col-md-3 control-label',
            ],
            'attr' => [
                'placeholder' => trans('admin.users.elements.position'),
            ],
            'widget_prefix' => '<div class="col-md-9">',
            'widget_suffix' => '</div>',
        ]);

        $this->add('gender', 'choice', [
            'label' => trans('admin.users.fields.gender'),
            'label_attr' => [
                'class' => 'control-label',
            ],
            'attr' => [
                'class' => 'form-control',
            ],
            'widget_prefix' => '<div class="clip-radio radio-primary">',
            'widget_suffix' => '</div>',
            'choices' => $this->getGenders(),
            'expanded' => true,
            'multiple' => false,
        ]);

        $this->add('image_path', 'text', [
            'label' => trans('admin.users.fields.image_path'),
            'label_attr' => [
                'class' => 'control-label',
            ],
            'attr' => [
                'placeholder' => trans('admin.users.elements.image_path'),
            ],
        ]);

        $this->add('birthday', 'text', [
            'label' => trans('admin.users.fields.birthday'),
            'label_attr' => [
                'class' => 'control-label',
            ],
            'attr' => [
                'placeholder' => trans('admin.users.elements.birthday'),
                'class' => 'form-control datetimepicker regular dir-ltr',
                'data-format' => 'Y-MM-DD',
            ],
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

        $this->add('approved_at', 'static', [
            'label' => trans('admin.users.fields.approved_at'),
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

        $this->add('approved_by', 'static', [
            'label' => trans('admin.users.fields.approved_by'),
            'label_attr' => [
                'class' => 'control-label col-md-8',
            ],
            'attr' => [
                'class' => 'form-control-static',
            ],
            'widget_prefix' => '<div class="col-md-4">',
            'widget_suffix' => '</div>',
            'value' => $this->getApprovedByName(),
        ]);

        $this->add('roles', 'choice', [
            'label' => false,
            'choice_options' => [
                'label_attr' => [
                    'class' => '',
                ],
                'wrapper' => [
                    'class' => 'col-md-3 checkbox clip-check check-primary checkbox-inline',
                ],
            ],
            'selected' => $this->getSelectedRoles(),
            'choices' => $this->getRoles(),
            'expanded' => true,
            'multiple' => true,
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

    protected function getGenders()
    {
        return Gender::flipTrans('admin.users.elements.gender_');
    }

    protected function getApprovedByName()
    {
        $model = $this->getModel();

        return ($model && $model->approver) ? $model->approver->display_name : trans('admin.users.elements.User is not approved');
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

    protected function getRoles()
    {
        return Role::query()->enabled()->pluck('title', 'id')->toArray();
    }

    protected function getSelectedRoles()
    {
        $model = $this->getModel();

        return $model ? $model->roles()->pluck('id')->toArray() : [];
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