<?php

namespace App\Repositories\Settings;

use anlutro\LaravelSettings\SettingStore;

class SettingRepository
{
    protected $settings;

    public function __construct(SettingStore $settings)
    {
        $this->settings = $settings;
    }

    public function update($data)
    {
        foreach($data as $key => $value){
            $this->settings->set($key, $value);
        }

        $this->settings->save();

        return true;
    }

    public function all()
    {
        return $this->settings->all();
    }

    public function get($key, $default = null)
    {
        return $this->settings->get($key, $default);
    }
}