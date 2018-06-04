<?php

namespace App\Http\Forms\Admin;


use App\Http\Forms\BaseForm;
use App\Types\State;

class AdminBaseForm extends BaseForm
{
    protected $hasStateField = true;

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

        if ($this->hasStateField()) {
            $this->add('state', 'checkbox', [
                'label' => false,//trans('admin.defaults.fields.state'),
                'label_attr' => [
                    'class' => 'col-md-3 control-label',
                ],
                'attr' => [
                    'data-toggle' => 'toggle',
                    'data-on' => trans('admin.defaults.elements.enabled'),
                    'data-off' => trans('admin.defaults.elements.disabled'),
                    'data-size' => 'large',
                ],
                'wrapper' => [
                    'class' => 'form-group dir-ltr',
                ],
                'checked' => $this->stateIsChecked(),
            ]);
        }
    }

    protected function stateIsChecked()
    {
        $model = $this->getModel();

        return $model && $model->state->getValue() == State::DISABLED ? false : true;
    }

    protected function hasStateField()
    {
        return $this->hasStateField;
    }
}