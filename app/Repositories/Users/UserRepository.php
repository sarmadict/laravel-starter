<?php

namespace App\Repositories\Users;

use App\Models\Users\User;
use App\Repositories\Repository;
use App\Types\State;
use DB;
use Exception;

class UserRepository extends Repository
{
    public function __construct(User $model)
    {
        $this->setModel($model);
    }

    public function getAdminDatatable()
    {
        $query = $this->query()
            //->with(['creator', 'updater', 'approver'])
            ->select([
                'users.id',
                'users.state',
                'users.first_name',
                'users.last_name',
                'users.email',
                'users.username',
                'users.mobile_number',
                'users.position',
                'users.created_at',
                'users.approved_at',
            ]);

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
            'gender' => $data['gender'],
            'state' => State::ENABLED,
            'password' => bcrypt($data['password'])
        ]);
    }

    public function createUser($data)
    {
        try {
            DB::beginTransaction();

            $item =  $this->forceCreate([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'display_name' => array_get($data, 'display_name', null) ?? $data['first_name'] . " " . $data['last_name'],
                'email' => $data['email'],
                'username' => $data['username'],
                'mobile_number' => $this->normalizeMobileNumber($data['mobile_number']),
                'gender' => $data['gender'],
                'position' => $data['position'],
                'birthday' => array_get($data, 'birthday'),
                'image_path' => $data['image_path'],
            ]);

            $item->roles()->sync(array_get($data, 'roles', []));

            $item->permissions()->sync(array_get($data, 'permissions', []));

            DB::commit();

            return $item;

        } catch (Exception $e) {
            \DB::rollBack();

            throw $e;
        }
    }

    public function updateUser($item, $data)
    {
        try {
            DB::beginTransaction();

            $item = $this->forceUpdate($item, [
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'display_name' => array_get($data, 'display_name', null) ?? $data['first_name'] . " " . $data['last_name'],
                'email' => $data['email'],
                'username' => $data['username'],
                'mobile_number' => $this->normalizeMobileNumber($data['mobile_number']),
                'gender' => $data['gender'],
                'position' => $data['position'],
                'birthday' => array_get($data, 'birthday', null),
                'image_path' => $data['image_path'],
            ]);

            $item->roles()->sync(array_get($data, 'roles', []));

            $item->permissions()->sync(array_get($data, 'permissions', []));

            DB::commit();

            return $item;

        } catch (Exception $e) {
            \DB::rollBack();

            throw $e;
        }
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