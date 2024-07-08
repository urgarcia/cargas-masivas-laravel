<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PersonService;

class PersonController extends Controller
{
    protected $personService;

    public function __construct(PersonService $personService)
    {
        $this->personService = $personService;
    }

    public function index(Request $request)
    {
        $offset = $request->input('offset', 0);
        $limit = $request->input('limit', 100);

        $persons = $this->personService->getAllPersons($offset, $limit);

        return response()->json($persons);
    }

    public function show($id)
    {
        $personDetails = $this->personService.getPersonDetails($id);

        return response()->json($personDetails);
    }
}
