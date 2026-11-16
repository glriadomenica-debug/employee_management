<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $query = Employee::with('departmentRecord');

        // Search employees by name
        if ($request->filled('search')) {
            $query->where(
                'full_name',
                'ILIKE',
                '%' . $request->search . '%'
            );
        }

        // Filter employees by department ID
        if ($request->filled('department_id')) {
            $query->where(
                'department_id',
                $request->department_id
            );
        }

        $employees = $query
            ->orderBy('id', 'desc')
            ->paginate(5)
            ->withQueryString();

        // Load departments from PostgreSQL
        $departments = Department::orderBy('name')->get();

        $totalEmployees = Employee::count();

        $averageSalary = Employee::whereNotNull('salary')
            ->avg('salary');

        $totalDepartments = Department::count();

        return view('employees.index', compact(
            'employees',
            'departments',
            'totalEmployees',
            'averageSalary',
            'totalDepartments'
        ));
    }

    public function create()
    {
        $departments = Department::orderBy('name')->get();

        return view('employees.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:100',
            'department_id' => 'required|integer|exists:departments,id',
            'salary' => 'nullable|numeric|min:0',
            'hire_date' => 'nullable|date',
        ]);

        Employee::create($validated);

        return redirect()
            ->route('employees.index')
            ->with('success', 'Employee created successfully.');
    }

    public function edit(Employee $employee)
    {
        $departments = Department::orderBy('name')->get();

        return view('employees.edit', compact(
            'employee',
            'departments'
        ));
    }

    public function update(Request $request, Employee $employee)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:100',
            'department_id' => 'required|integer|exists:departments,id',
            'salary' => 'nullable|numeric|min:0',
            'hire_date' => 'nullable|date',
        ]);

        $employee->update($validated);

        return redirect()
            ->route('employees.index')
            ->with('success', 'Employee updated successfully.');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()
            ->route('employees.index')
            ->with('success', 'Employee deleted successfully.');
    }
}
