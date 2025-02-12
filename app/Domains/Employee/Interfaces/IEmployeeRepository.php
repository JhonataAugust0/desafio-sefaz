<?php

namespace App\Domains\Employee\Interfaces;

interface IEmployeeRepository
{
    public function getAll();

    public function create(array $data);

    public function update(array $data);

    public function delete(int $id);
}
