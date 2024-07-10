<?php

namespace App\Repositories;

use App\Models\Direccion;

class AddressRepository {
    public function getAll($offset, $limit) {
        return Direccion::offset($offset)->limit($limit)->get();
    }

    public function find($id) {
        return Direccion::find($id);
    }
}