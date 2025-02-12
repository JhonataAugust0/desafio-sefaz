<?php

namespace App\Domains\Employee\Repositories;

use App\Domains\Employee\Interfaces\IEmployeeRepository;
use App\Models\User;

class EmployeeRepository implements IEmployeeRepository
{
    public function getAll()
    {
        return User::where('role', 'user')->select(['id', 'name', 'email', 'sector'])->get();
    }

    public function create(array $data)
    {
        return User::create($data);
    }

    public function update(array $data)
    {
        $user = User::findOrFail($data['id']);
        return $user->update($data);
    }

    public function delete(int $id)
    {
        $user = User::findOrFail($id);
        return $user->delete();
    }
}
