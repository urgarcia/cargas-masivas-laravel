<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'userType',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'userType', 'created_at', 'updated_at', 'email_verified_at'
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    public function menus()
    {
        return $this->roles()->with('menus')->get()->pluck('menus')->flatten()->unique('id');
    }
}
