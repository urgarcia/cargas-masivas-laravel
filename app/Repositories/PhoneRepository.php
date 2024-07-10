<?php

namespace App\Repositories;

use App\Models\Telefono;

class PhoneRepository {
    public function getAll($offset, $limit) {
        return Telefono::offset($offset)->limit($limit)->get();
    }

    public function find($id) {
        return Telefono::find($id);
    }
}