<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::orderBy('id', 'desc')->get();
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        return view('employees.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:100',
            'department' => 'nullable|string|max:50',
            'salary' => 'nullable|numeric|min:0',
            'hire_date' => 'nullable|date',
        ]);

        Employee::create($validated);

        return redirect()
            ->route('employees.index')
            ->with('success', 'Employee successfully created!');
    }

    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, Employee $employee)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:100',
            'department' => 'nullable|string|max:50',
            'salary' => 'nullable|numeric|min:0',
            'hire_date' => 'nullable|date',
        ]);

        $employee->update($validated);

        return redirect()
            ->route('employees.index')
            ->with('success', 'Employee Updated Successfully!');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()
            ->route('employees.index')
            ->with('success', 'Employee deleted successfully!');
    }
}
