<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display employees with search, department filter, and statistics.
     */
    public function index(Request $request)
    {
        $query = Employee::with('departmentRecord');

        // Search by employee name.
        if ($request->filled('search')) {
            $query->where(
                'full_name',
                'ILIKE',
                '%' . $request->input('search') . '%'
            );
        }

        // Filter by department.
        if ($request->filled('department_id')) {
            $query->where(
                'department_id',
                $request->input('department_id')
            );
        }

        // Get employees with pagination.
        $employees = $query
            ->orderByDesc('id')
            ->paginate(5)
            ->withQueryString();

        // Get departments dynamically from PostgreSQL.
        $departments = Department::orderBy('name')->get();

        // Dashboard statistics.
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

    /**
     * Show the Add Employee form.
     */
    public function create()
    {
        $departments = Department::orderBy('name')->get();

        return view('employees.create', compact('departments'));
    }

    /**
     * Save a new employee.
     */
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

    /**
     * Show the Edit Employee form.
     */
    public function edit(Employee $employee)
    {
        $departments = Department::orderBy('name')->get();

        return view('employees.edit', compact(
            'employee',
            'departments'
        ));
    }

    /**
     * Update an existing employee.
     */
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

    /**
     * Delete an employee.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()
            ->route('employees.index')
            ->with('success', 'Employee deleted successfully.');
    }
}
