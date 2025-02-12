<?php

namespace App\Domains\Employee\Interfaces;

interface IEmployeeService
{
    public function listEmployees();

    public function createEmployee(array $data);

    public function updateEmployee(array $data);

    public function deleteEmployee(int $id);
}
