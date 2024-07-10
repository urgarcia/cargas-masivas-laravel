<?php

namespace App\Services;

use App\Repositories\PersonRepository;

class UploadService {
    protected $personRepository;

    public function __construct(PersonRepository $personRepository) {
        $this->personRepository = $personRepository;
    }

    public function uploadFile($request) {
        // Almacenar el archivo temporalmente
        $filePath = $request->file('files')[0]->storeAs('uploads', 'temp.csv');
        // Procesar el archivo CSV
        $this->processCSV(storage_path('app/' . $filePath));
    }

    protected function processCSV($filePath){
        // Verificar que la ruta del archivo es correcta
        if (!file_exists($filePath)) {
            throw new \Exception("File not found at path: $filePath");
        }
        // Escapar correctamente la ruta del archivo para MySQL
        $escapedFilePath = addslashes($filePath);
        // Usar la funcionalidad de LOAD DATA LOCAL INFILE
        $this->personRepository->uploadFile($escapedFilePath);
        // Llamar al servicio para migrar los datos
        $this->personRepository->migrateData();
    }

}
