<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Employee Management')</title>
  <link rel="icon" href="https://www.shutterstock.com/image-vector/employee-vector-icon-logo-sign-260nw-2676671729.jpg" />

  <style>
    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background: #f4f7fb;
      color: #1f2937;
    }

    header {
      background: #173b70;
      color: white;
      padding: 20px 6%;
    }

    header h2 {
      margin: 0;
    }

    main {
      max-width: 1100px;
      margin: 35px auto;
      padding: 0 20px;
    }

    .card {
      background: white;
      padding: 24px;
      border-radius: 12px;
      box-shadow: 0 3px 12px #0000000c;
    }

    .toolbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 12px;
      flex-wrap: wrap;
      margin-bottom: 20px;
    }

    .btn {
      display: inline-block;
      border: 0;
      border-radius: 6px;
      padding: 10px 15px;
      background: #2563eb;
      color: white;
      text-decoration: none;
      cursor: pointer;
      font-size: 14px;
    }

    .btn-danger {
      background: #dc2626;
    }

    .btn-secondary {
      background: #64748b;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th,
    td {
      text-align: left;
      padding: 13px 10px;
      border-bottom: 1px solid #e5e7eb;
    }

    th {
      background: #f8fafc;
      font-size: 13px;
    }

    input {
      width: 100%;
      padding: 11px;
      margin: 7px 0 16px;
      border: 1px solid #cbd5e1;
      border-radius: 6px;
    }

    label {
      font-weight: bold;
      font-size: 14px;
    }

    .alert {
      padding: 12px;
      margin-bottom: 18px;
      border-radius: 6px;
      background: #dcfce7;
      color: #166534;
    }

    .error {
      color: #dc2626;
      margin-top: -12px;
      margin-bottom: 12px;
    }

    .actions {
      display: flex;
      gap: 6px;
      align-items: center;
    }

    .actions form {
      margin: 0;
    }

    nav[role="navigation"] {
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      gap: 10px;
      margin-top: 16px;
    }

    nav[role="navigation"] a,
    nav[role="navigation"] span {
      display: inline-block;
      padding: 7px 11px;
      border: 1px solid #cbd5e1;
      border-radius: 5px;
      text-decoration: none;
      color: #1f2937;
    }

    @media (max-width: 650px) {
      .table-wrap {
        overflow-x: auto;
      }

      th,
      td {
        white-space: nowrap;
      }
    }
  </style>

</head>

<body>
  <header>
    <h2>Employee Management</h2>
  </header>

  <main>
    @yield('content')
  </main>

</body>

</html>