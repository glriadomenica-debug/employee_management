@extends('employees.layout')

@section('title', 'Edit Employee')

@section('content')
  <div class="card">
    <h2>Edit Employee</h2>

    <form method="POST" action="{{ route('employees.update', $employee->id) }}">
      @csrf
      @method('PUT')

      <label for="full_name">Full Name *</label>
      <input id="full_name" name="full_name" value="{{ old('full_name', $employee->full_name) }}" required
        maxlength="100">
      @error('full_name')
        <div class="error">{{ $message }}</div>
      @enderror

      <label for="department_id">Department *</label>
      <select id="department_id" name="department_id" required>
        <option value="">-- Select Department --</option>

        @foreach ($departments as $department)
          <option value="{{ $department->id }}" {{ old('department_id', $employee->department_id) == $department->id ? 'selected' : '' }}>
            {{ $department->name }}
          </option>
        @endforeach
      </select>

      @error('department_id')
        <div class="error">{{ $message }}</div>
      @enderror

      <label for="salary">Salary</label>
      <input id="salary" type="number" name="salary" step="0.01" min="0" value="{{ old('salary', $employee->salary) }}">
      @error('salary')
        <div class="error">{{ $message }}</div>
      @enderror

      <label for="hire_date">Hire Date</label>
      <input id="hire_date" type="date" name="hire_date"
        value="{{ old('hire_date', $employee->hire_date?->format('Y-m-d')) }}">
      @error('hire_date')
        <div class="error">{{ $message }}</div>
      @enderror

      <button class="btn" type="submit">Update Employee</button>

      <a href="{{ route('employees.index') }}" class="btn btn-secondary">
        Cancel
      </a>
    </form>
  </div>
@endsection