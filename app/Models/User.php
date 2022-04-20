<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    protected $table = 'users';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'mobile',
        'role',
        'status',
        'profile_pic'
    ];

    protected $hidden = ['password', 'remember_token'];

    public function isAdmin() {
       return $this->role === 'admin';
    }

    public function isSubAdmin() {
        return $this->role === 'subadmin';
    }

    public function isAgent() {
        return $this->role === 'agent';
    }

    public function isUser() {
       return $this->role === 'user';
    }
    public function tickets(){
        return $this->hasMany(Ticket::class);
    }
}