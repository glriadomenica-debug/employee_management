@extends('employees.layout')

@section('title', 'Add Employee')

@section('content')
  <div class="card">
    <h2>Add Employee</h2>

    <form method="POST" action="{{ route('employees.store') }}">
      @csrf

      <label>Full Name *</label>
      <input name="full_name" value="{{ old('full_name') }}" required maxlength="100">
      @error('full_name')
        <div class="error">{{ $message }}</div>
      @enderror

      <label>Department</label>
      <input name="department" value="{{ old('department') }}" maxlength="50">
      @error('department')
        <div class="error">{{ $message }}</div>
      @enderror

      <label>Salary</label>
      <input type="number" name="salary" step="0.01" min="0" value="{{ old('salary') }}">
      @error('salary')
        <div class="error">{{ $message }}</div>
      @enderror

      <label>Hire Date</label>
      <input type="date" name="hire_date" value="{{ old('hire_date') }}">
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