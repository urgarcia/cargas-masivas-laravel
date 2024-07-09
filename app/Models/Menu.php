<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $table = 'menus'; // Name of the menus table

    protected $fillable = [
        'name', // Name of the menu (e.g., 'Inicio', 'Mi Cartera', 'Perfil', 'Usuarios')
        'url', // URL of the menu (optional)
        'icon', // URL of the menu (optional)
    ];
    protected $hidden = [
        'pivot', 'created_at', 'updated_at',
    ];


    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_menu'); // Many-to-many relationship with roles through the role_menu pivot table
    }
}
