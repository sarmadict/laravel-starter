<?php

namespace App\Repositories\Users;

use App\Models\Users\User;
use App\Repositories\Repository;
use App\Types\State;

class UserRepository extends Repository
{
    public function __construct(User $model)
    {
        $this->setModel($model);
    }

    public function registerUser($data)
    {
        return $this->forceCreate([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'display_name' => $data['first_name'] . " " . $data['last_name'],
            'email' => $data['email'],
            'username' => $data['username'],
            'gender' => $data['gender'],
            'state' => State::ENABLED,
            'password' => bcrypt($data['password'])
        ]);
    }

    public function createUser($data)
    {
        return $this->forceCreate([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'display_name' => array_get($data, 'display_name', null) ?? $data['first_name'] . " " . $data['last_name'],
            'email' => $data['email'],
            'username' => $data['username'],
            'mobile_number' => $data['mobile_number'],
            'gender' => $data['gender'],
            'position' => $data['position'],
            'birthday' => $data['birthday'],
            'image_path' => $data['image_path'],
        ]);
    }

    public function normalizeMobileNumber($mobile)
    {
        return preg_replace('/[^0-9]/', '', $mobile);
    }

    public function normalizeBirthdate($year, $month, $day)
    {
        return implode('-', [
            str_pad($year, 4, '0', STR_PAD_LEFT),
            str_pad($month, 2, '0', STR_PAD_LEFT),
            str_pad($day, 2, '0', STR_PAD_LEFT),
        ]);
    }
}