<?php

namespace App\Modules\Admin\Settings\Forms;


use App\Http\Forms\Admin\AdminBaseForm;
use App\Models\Permissions\Permission;

class GeneralSettingForm extends AdminBaseForm
{
    protected $hasStateField = false;

    public function buildForm()
    {
        parent::buildForm();

        $this->add('application_title', 'text', [
            'label' => trans('admin.settings.fields.application_title'),
            'label_attr' => [
                'class' => 'col-md-3 control-label',
            ],
            'attr' => [
                'placeholder' => trans('admin.settings.elements.application_title'),
            ],
            'widget_prefix' => '<div class="col-md-9">',
            'widget_suffix' => '</div>',
        ]);
    }
}