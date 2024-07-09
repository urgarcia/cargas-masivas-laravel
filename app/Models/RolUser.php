<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolUser extends Model
{
    use HasFactory;

    protected $table = 'role_user'; // Name of the role_user pivot table

    public $timestamps = false; // Disable timestamps for pivot table

    protected $fillable = [
        'user_id', // User ID
        'role_id', // Role ID
    ];

    public function user()
    {
        return $this->belongsTo(User::class); // Belongs-to relationship with users
    }

    public function role()
    {
        return $this->belongsTo(Role::class); // Belongs-to relationship with roles
    }
}
