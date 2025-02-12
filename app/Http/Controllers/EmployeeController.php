<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function index()
    {
        return Inertia::render('Dashboard', [
            'employees' => User::where('role', 'user')->select(['id', 'name', 'email', 'sector'])->get(),
            'sectors' => ['Contabilidade', 'Financeiro', 'Atendimento', 'Orçamento', 'TI']
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:users',
            'sector' => 'required|string|max:30',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'sector' => $validated['sector'],
            'password' => Hash::make($validated['password']),
            'role' => 'user',
        ]);

        return redirect()->back()->with('message', 'Funcionário cadastrado com sucesso');
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|exists:users,id',
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:users,email,' . $request->id,
            'sector' => 'required|string|max:30',
        ]);

        $user = User::findOrFail($validated['id']);
        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'sector' => $validated['sector'],
        ]);

        return redirect()->back()->with('message', 'Funcionário atualizado com sucesso');
    }

    public function destroy(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|exists:users,id'
        ]);

        $user = User::findOrFail($validated['id']);
        $user->delete();

        return redirect()->back()->with('message', 'Funcionário excluído com sucesso');
    }
}
