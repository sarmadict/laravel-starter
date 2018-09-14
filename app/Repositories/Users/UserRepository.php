<?php

namespace App\Repositories\Users;

use App\Models\Users\User;
use App\Repositories\Repository;
use App\Types\State;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserRepository extends Repository
{
    public function __construct(User $model)
    {
        $this->setModel($model);
    }

    public function getAdminDatatable()
    {
        $query = $this->query();

        return $query;
    }

    public function registerUser($data)
    {
        return $this->forceCreate([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'display_name' => $data['first_name'] . " " . $data['last_name'],
            'email' => $data['email'],
            'username' => $data['username'],
            'state' => State::ENABLED,
            'password' => bcrypt($data['password'])
        ]);
    }

    public function createUser($data)
    {
        $auth = Auth::user();

        DB::beginTransaction();

        $item = $this->forceCreate([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'display_name' => array_get($data, 'display_name', null) ?? $data['first_name'] . " " . $data['last_name'],
            'email' => $data['email'],
            'username' => $data['username'],
            'mobile_number' => $this->normalizeMobileNumber($data['mobile_number']),
            'gender' => array_get($data, 'gender', null),
            'position' => $data['position'],
            'birthday' => array_get($data, 'birthday'),
            'image_path' => $data['image_path'],
            'state' => array_has($data, 'state') ? State::ENABLED : State::DISABLED,
            'created_by' => $auth->id,
            'updated_by' => $auth->id,
        ]);

        $item->roles()->sync(array_get($data, 'roles', []));

        $item->permissions()->sync(array_get($data, 'permissions', []));

        DB::commit();

        return $item;
    }

    public function updateUser($item, $data)
    {

        $auth = Auth::user();

        DB::beginTransaction();

        $item = $this->forceUpdate($item, [
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'display_name' => array_get($data, 'display_name', null) ?? $data['first_name'] . " " . $data['last_name'],
            'email' => $data['email'],
            'username' => $data['username'],
            'mobile_number' => $this->normalizeMobileNumber($data['mobile_number']),
            'gender' => array_get($data, 'gender', null),
            'position' => $data['position'],
            'birthday' => array_get($data, 'birthday', null),
            'image_path' => $data['image_path'],
            'state' => array_has($data, 'state') ? State::ENABLED : State::DISABLED,
            'updated_by' => $auth->id,
        ]);

        $item->roles()->sync(array_get($data, 'roles', []));

        $item->permissions()->sync(array_get($data, 'permissions', []));

        DB::commit();

        return $item;
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

    public function simpleSearch($term)
    {
        return $this->getModel()->newQuery()
            ->where("first_name", "like", $term)
            ->orWhere("last_name", "like", $term)
            ->orWhere("mobile_number", "like", $term)
            ->orWhere("email", "like", $term);
    }
}