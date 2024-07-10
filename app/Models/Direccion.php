<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    use HasFactory;
    protected $table = 'direcciones'; // Name of the roles table


    protected $fillable = [
        'persona_id', 'calle', 'numero_exterior', 'numero_interior', 'colonia', 'cp'
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }
}
