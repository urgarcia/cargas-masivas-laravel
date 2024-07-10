<?php

namespace App\Services;

use App\Repositories\PersonRepository;
use App\Repositories\PhoneRepository;
use App\Repositories\AddressRepository;

class PersonService {
    protected $personRepository;
    protected $phoneRepository;
    protected $addressRepository;

    public function __construct(PersonRepository $personRepository, PhoneRepository $phoneRepository, AddressRepository $addressRepository) {
        $this->personRepository = $personRepository;
        $this->phoneRepository = $phoneRepository;
        $this->addressRepository = $addressRepository;
    }

    public function migrateData($data) {
        // Lógica para procesar datos y migrarlos a las tablas correspondientes
    }

    public function getAllPersons($offset, $limit) {
        return $this->personRepository->getAll($offset, $limit);
    }

    public function getPersonDetails($id) {
    }
}
