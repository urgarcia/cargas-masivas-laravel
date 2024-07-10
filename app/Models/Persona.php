<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre', 'paterno', 'materno'
    ];

    public function telefonos()
    {
        return $this->hasMany(Telefono::class);
    }

    public function direcciones()
    {
        return $this->hasMany(Direccion::class);
    }
}
