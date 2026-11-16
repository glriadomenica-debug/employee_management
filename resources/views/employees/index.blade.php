@extends('employees.layout')
@section('title', 'Employees')
@section('content')
  <div class="card">
    <div class="toolbar">
      <div>
        <h2>Employees</h2>
        <p>Manage your employee records.</p>
      </div>

      <a href="{{ route('employees.create') }}" class="btn">
        + Add Employee
      </a>
    </div>

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
              <td>{{ $employee->department ?? '-' }}</td>
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
  </div>
@endsection