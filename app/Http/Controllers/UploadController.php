<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\PersonService;

class UploadController extends Controller
{
    protected $personService;

    public function __construct(PersonService $personService)
    {
        $this->personService = $personService;
    }

    public function store(Request $request)
    {
        // Validar que el archivo sea un Excel
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        // Almacenar el archivo temporalmente
        $filePath = $request->file('file')->storeAs('uploads', 'temp.xlsx');

        // Procesar el archivo para la carga masiva
        $this->processExcel(storage_path('app/' . $filePath));

        return response()->json(['message' => 'File uploaded and processed successfully'], 200);
    }

    protected function processExcel($filePath)
    {
        // Usar la funcionalidad de LOAD DATA LOCAL INFILE
        DB::statement("LOAD DATA LOCAL INFILE '$filePath' INTO TABLE temp_poblacion
            FIELDS TERMINATED BY ',' 
            ENCLOSED BY '\"' 
            LINES TERMINATED BY '\n' 
            IGNORE 1 LINES 
            (nombre, paterno, materno, telefono, calle, numero_exterior, numero_interior, colonia, cp)");

        // Llamar al servicio para migrar los datos
        $this->personService->migrateData();
    }
}
