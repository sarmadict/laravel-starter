<?php

namespace App\Http\Forms\Admin;


use App\Http\Forms\BaseForm;

class AdminBaseForm extends BaseForm
{
    public function buildForm()
    {
        parent::buildForm();

        $this->add('SaveAndReload', 'submit', [
            'label' => '<i class="fa fa-check"></i> ' . trans('admin.defaults.actions.SaveAndReload'),
            'attr' => [
                'class' => 'btn btn-green',
                'value' => 'SaveAndReload',
            ]
        ]);

        $this->add('SaveAndClose', 'submit', [
            'label' => trans('admin.defaults.actions.SaveAndClose'),
            'attr' => [
                'class' => 'btn btn-azure',
                'value' => 'SaveAndClose',
            ]
        ]);

        $this->add('SaveAndNew', 'submit', [
            'label' => trans('admin.defaults.actions.SaveAndNew'),
            'attr' => [
                'class' => 'btn btn-primary',
                'value' => 'SaveAndNew',
            ]
        ]);

        $this->add('SaveAndShow', 'submit', [
            'label' => trans('admin.defaults.actions.SaveAndShow'),
            'attr' => [
                'class' => 'btn btn-yellow',
                'value' => 'SaveAndShow',
            ]
        ]);
    }
}