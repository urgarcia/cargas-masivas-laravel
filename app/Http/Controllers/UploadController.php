<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\UploadService;
use App\Services\PersonService;
class UploadController extends Controller
{
    protected $personService;
    protected $uploadService;

    public function __construct(PersonService $personService, UploadService $uploadService)
    {
        $this->personService = $personService;
        $this->uploadService = $uploadService;
    }

    public function store(Request $request)
    {
        // Validar que el archivo sea un csv
        $request->validate([
            'files' => 'required'
        ]);
        $this->uploadService->uploadFile($request);
        return response()->json(['message' => 'File uploaded and processed successfully'], 200);
    }

}
