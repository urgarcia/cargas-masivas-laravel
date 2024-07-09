<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles'; // Name of the roles table

    protected $fillable = [
        'name', // Name of the role (e.g., 'admin', 'user')
    ];
    protected $hidden = [
        'pivot', 'created_at', 'updated_at',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'role_user');
    }
    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'role_menu');
    }
}

