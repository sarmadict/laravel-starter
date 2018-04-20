<?php

namespace App\Http\Forms\Panel\Admin;


use App\Http\Forms\BaseForm;

class AdminBaseForm extends BaseForm
{
    public function buildForm()
    {
        parent::buildForm();

        $this->add('SaveAndReload', 'submit', [
            'label' => '<i class="fa fa-check"></i> ' . trans('panel.admin.defaults.SaveAndReload'),
            'attr' => [
                'class' => 'btn btn-green',
                'value' => 'SaveAndReload',
            ]
        ]);

        $this->add('SaveAndClose', 'submit', [
            'label' => trans('panel.admin.defaults.SaveAndClose'),
            'attr' => [
                'class' => 'btn btn-azure',
                'value' => 'SaveAndClose',
            ]
        ]);

        $this->add('SaveAndNew', 'submit', [
            'label' => trans('panel.admin.defaults.SaveAndNew'),
            'attr' => [
                'class' => 'btn btn-primary',
                'value' => 'SaveAndNew',
            ]
        ]);

        $this->add('SaveAndShow', 'submit', [
            'label' => trans('panel.admin.defaults.SaveAndShow'),
            'attr' => [
                'class' => 'btn btn-yellow',
                'value' => 'SaveAndShow',
            ]
        ]);
    }
}