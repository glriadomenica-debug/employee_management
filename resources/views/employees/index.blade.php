@extends('employees.layout')
@section('title', 'Employees')
@section('content')
  <div class="card">
    <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(180px,1fr)); gap:15px; margin-bottom:25px;">

      <div style="padding:20px; background:#eff6ff; border-radius:10px;">
        <p>Total Employees</p>
        <h2>{{ $totalEmployees }}</h2>
      </div>

      <div style="padding:20px; background:#f0fdf4; border-radius:10px;">
        <p>Average Salary</p>
        <h2>{{ $averageSalary !== null ? '$' . number_format((float) $averageSalary, 2) : '-' }} </h2>
      </div>

      <div style="padding:20px; background:#fff7ed; border-radius:10px;">
        <p>Departments</p>
        <h2>{{ $totalDepartments }}</h2>
      </div>

    </div>
    <div class="toolbar">
      <div>
        <h2>Employees</h2>
        <p>Manage your employee records.</p>
      </div>

      <a href="{{ route('employees.create') }}" class="btn">
        + Add Employee
      </a>
    </div>

    <form method="GET" action="{{ route('employees.index') }}"
      style="display:flex; gap:10px; flex-wrap:wrap; margin-bottom:20px;">

      <input type="text" name="search" placeholder="Search employee name..." value="{{ request('search') }}"
        style="flex:1; min-width:180px; margin:0;">

      <select name="department"
        style="flex:1; min-width:160px; padding:10px; border:1px solid #cbd5e1; border-radius:6px;">
        <option value="">All departments</option>

        @foreach ($departments as $department)
          <option value="{{ $department }}" {{ request('department') === $department ? 'selected' : '' }}>
            {{ $department }}
          </option>
        @endforeach
      </select>

      <button type="submit" class="btn">Search</button>

      <a href="{{ route('employees.index') }}" class="btn btn-secondary">
        Reset
      </a>
    </form>

    @if (session('success'))
      <div class="alert">{{ session('success') }}</div>
    @endif

    <div class="table-wrap">
      <table>
        <thead>
          <tr>
            <th>No.</th>
            <th>Name</th>
            <th>Department</th>
            <th>Salary</th>
            <th>Hire Date</th>
            <th>Actions</th>
          </tr>
        </thead>

        <tbody>
          @forelse ($employees as $employee)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $employee->full_name }}</td>
              <td>{{ $employee->departmentRecord?->name ?? 'Unassigned' }}</td>
              <td>{{ $employee->salary !== null ? '$' . number_format((float) $employee->salary, 2) : '-' }}</td>
              <td>{{ $employee->hire_date?->format('Y-m-d') ?? '-' }}</td>
              <td>
                <div class="actions">
                  <a class="btn btn-secondary" href="{{ route('employees.edit', $employee) }}">
                    Edit
                  </a>

                  <form method="POST" action="{{ route('employees.destroy', $employee) }}"
                    onsubmit="return confirm('Delete this employee?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">
                      Delete
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6">
                No employees yet. Click "Add Employee" to create one.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
    <div style="margin-top:20px;">
      {{ $employees->links() }}
    </div>
  </div>
@endsection