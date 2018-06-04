<?php

namespace App\Modules\Admin\Settings\Requests;


use App\Http\Requests\Admin\AdminBaseRequest;
use App\Models\Settings\Setting;
use App\Types\State;
use Illuminate\Validation\Rule;

class UpdateSettingsRequest extends AdminBaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $type = $this->route('type');

        return $this->user()->can("admin.settings_{$type}.edit");
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $type = $this->route('type');

        return $this->{$type . "Rules"}();
    }

    public function generalRules()
    {
        return [
            'application_title' => '',
        ];
    }
}