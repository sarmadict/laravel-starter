<?php

namespace App\Modules\Admin\Settings\Controllers;


use App\Http\Controllers\Admin\AdminBaseController;
use App\Modules\Admin\Settings\Requests\UpdateSettingsRequest;
use App\Repositories\Settings\SettingRepository;
use App\Services\Alert\Facade\Alert;
use Exception;
use Kris\LaravelFormBuilder\Facades\FormBuilder;

class SettingsController extends AdminBaseController
{
    protected $settings;

    /**
     * Crate Settings Controller Instance
     *
     * @param SettingRepository $settings
     */
    public function __construct(SettingRepository $settings)
    {
        $this->settings = $settings;
    }

    /**
     * Show Settings edit form
     *
     * @param $type
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($type = 'general')
    {
        $this->authorize('admin.settings_general.edit');

        $form = FormBuilder::create($this->getClassForm($type), [
            'method' => 'PUT',
            'url' => route('admin.settings.update', $type),
            'model' => $this->settings->all(),
            'data' => [
                //
            ]
        ]);

        return view($this->getViewForm($type), compact('form'));
    }

    public function getClassForm($type)
    {
        return "App\\Modules\\Admin\\Settings\\Forms\\" . ucfirst($type) . "SettingForm";
    }

    public function getViewForm($type)
    {
        return "AdminSettings::" . $type . "-form";
    }

    public function update(UpdateSettingsRequest $request, $type)
    {
        $handler = 'prepare' . ucfirst($type) . "Fields";

        $this->settings->update($this->$handler($request));

        Alert::success(trans('admin.settings.elements.Settings updated successfully'));

        return redirect()->route('admin.settings.edit', $type);
    }

    public function prepareGeneralFields($request)
    {
        return [
            'application_title' => $request->input('application_title', ''),
        ];
    }
}
