<?php

namespace App\Domains\Employee\Services;

use App\Domains\Employee\Interfaces\IEmployeeRepository;
use App\Domains\Employee\Interfaces\IEmployeeService;
use Illuminate\Support\Facades\Hash;

class EmployeeService implements IEmployeeService
{
    protected $employeeRepository;

    public function __construct(IEmployeeRepository $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    public function listEmployees()
    {
        return $this->employeeRepository->getAll();
    }

    public function createEmployee(array $data)
    {
        $data['password'] = Hash::make($data['password']);
        return $this->employeeRepository->create($data);
    }

    public function updateEmployee(array $data)
    {
        return $this->employeeRepository->update($data);
    }

    public function deleteEmployee(int $id)
    {
        return $this->employeeRepository->delete($id);
    }
}
