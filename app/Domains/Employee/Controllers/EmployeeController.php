<?php

namespace App\Domains\Employee\Controllers;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Domains\Employee\Interfaces\IEmployeeService;

class EmployeeController extends Controller
{
    protected $employeeService;

    public function __construct(IEmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    public function index()
    {
        $employees = $this->employeeService->listEmployees();
        $sectors = ['Contabilidade', 'Financeiro', 'Atendimento', 'Orçamento', 'TI'];

        return Inertia::render('Dashboard', [
            'employees' => $employees,
            'sectors' => $sectors
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|string|email|max:100|unique:users',
            'sector'   => 'required|string|max:30',
        ]);
        $validatedData['password'] = bcrypt('stringst1');
        $this->employeeService->createEmployee($validatedData);

        return redirect()->back()->with('message', 'Funcionário cadastrado com sucesso');
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'id'     => 'required|exists:users,id',
            'name'   => 'required|string|max:100',
            'email'  => 'required|string|email|max:100|unique:users,email,' . $request->id,
            'sector' => 'required|string|max:30',
        ]);

        $this->employeeService->updateEmployee($validatedData);

        return redirect()->back()->with('message', 'Funcionário atualizado com sucesso');
    }

    public function destroy(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required|exists:users,id'
        ]);

        $this->employeeService->deleteEmployee($validatedData['id']);

        return redirect()->back()->with('message', 'Funcionário excluído com sucesso');
    }
}
