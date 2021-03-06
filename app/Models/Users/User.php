<?php

namespace App\Models\Users;


use App\Models\Traits\HasJalaliTimestamps;
use App\Models\Traits\HasState;
use App\Notifications\Accounts\Auth\ResetPassword as ResetPasswordNotification;
use App\Services\Acl\Traits\CanAuthorize;
use App\Services\Acl\Traits\HasPermission;
use App\Services\Acl\Traits\HasRole;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens, SoftDeletes,
        HasRole, HasPermission, CanAuthorize,
        UserRelationships, UserScopes, UserModifiers,
        HasState, HasJalaliTimestamps;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'username', 'mobile_number', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Create a new Eloquent model instance.
     *
     * @param  array $attributes
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(config('tables.users'));
    }

    /**
     * Send the password reset notification.
     *
     * @param  string $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    /**
     * Check if user account is approved or not
     *
     * @return bool
     */
    public function isApproved()
    {
        return !is_null($this->approved_at);
    }

    /**
     * Get a default image if nothing specified
     *
     * @return string
     */
    public function getDefaultImagePath()
    {
        // @todo: Decide between man and woman default image
        return '#';
    }
}
