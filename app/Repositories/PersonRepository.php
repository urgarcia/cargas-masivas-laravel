<?php

namespace App\Repositories;

use App\Models\Person;

class PersonRepository {
    public function getAll($offset, $limit) {
        return Person::offset($offset)->limit($limit)->get();
    }

    public function find($id) {
        return Person::find($id);
    }
}