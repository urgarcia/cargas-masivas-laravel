<?php

namespace App\Repositories;

use App\Models\Persona;
use Illuminate\Support\Facades\DB;


class PersonRepository
{
    public function getAll($offset, $limit)
    {
        return Persona::with("telefonos", "direcciones")->offset($offset)->limit($limit)->get();
    }

    public function find($id)
    {
        return Persona::find($id);
    }

    public function uploadFile($escapedFilePath)
    {
        
        try {
            // Inserta documento con DATA LOCAL INFILE
            DB::statement("LOAD DATA LOCAL INFILE '$escapedFilePath' INTO TABLE temp_poblacion
                FIELDS TERMINATED BY ',' 
                ENCLOSED BY '\"' 
                LINES TERMINATED BY '\n' 
                IGNORE 1 LINES 
                (nombre, paterno, materno, telefono, calle, numero_exterior, numero_interior, colonia, cp)");
        
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error executing stored procedure: ' . $e->getMessage()], 500);
        }
    }
    public function migrateData()
    {
        try {
            // Llama al stored procedure
            DB::statement('CALL ProcesarTempPoblacion()');
            
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error executing stored procedure: ' . $e->getMessage()], 500);
        }
    }
}