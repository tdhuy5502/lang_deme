<?php 

namespace App\Repositories;

use Illuminate\Support\Facades\File;

interface IfaceRepository {
    public function getModel();

    public function getAll();

    public function getById(string $id);

    public function save(array $data, string $id);

    public function delete(string $id);

}