@extends('employees.layout')

@section('title', 'Add Employee')

@section('content')
  <div class="card">
    <h2>Add Employee</h2>

    <form method="POST" action="{{ route('employees.store') }}">
      @csrf

      <label for="full_name">Full Name *</label>
      <input id="full_name" name="full_name" value="{{ old('full_name') }}" required maxlength="100">
      @error('full_name')
        <div class="error">{{ $message }}</div>
      @enderror


      <div class="form-group">
        <label for="department_id">Department</label>

        <select name="department_id" id="department_id" class="form-control" required>
          <option value="">-- Select Department --</option>

          @foreach ($departments as $department)
            <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>
              {{ $department->name }}
            </option>
          @endforeach
        </select>

        @error('department_id')
          <div class="error">{{ $message }}</div>
        @enderror
      </div>


      <label for="salary">Salary</label>
      <input id="salary" type="number" name="salary" step="0.01" min="0" value="{{ old('salary') }}">
      @error('salary')
        <div class="error">{{ $message }}</div>
      @enderror

      <label for="hire_date">Hire Date</label>
      <input id="hire_date" type="date" name="hire_date" value="{{ old('hire_date') }}">
      @error('hire_date')
        <div class="error">{{ $message }}</div>
      @enderror

      <button class="btn" type="submit">Save Employee</button>

      <a href="{{ route('employees.index') }}" class="btn btn-secondary">
        Cancel
      </a>
    </form>
  </div>
@endsection