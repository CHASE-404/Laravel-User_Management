<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>User Management System</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
</head>
<header>
  <div class="container">
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
      <span class="d-flex align-items-center mb-3 mb-md-0 me-md-auto fs-4">User Management System</span>
      <ul class="nav nav-pills">
        <li class="nav-item"><a href="/" class="nav-link active">Home</a></li>
        <li class="nav-item"><a href="/addUser" class="nav-link">Add Account</a></li>
        <li class="nav-item"><a href="/deleteUser" class="nav-link">Delete Account</a></li>
        <li class="nav-item"><a href="/updateUser" class="nav-link">Update Account</a></li>
      </ul>
    </header>
  </div>
</header>
<body>
<div class="container mt-5">
        <h4>User List</h4>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Profile Image</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->first_name }}</td>
                        <td>{{ $user->last_name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone_number }}</td>
                        <td>
                        @if ($user->profile_image)
                        <img src="{{ asset('storage/' . $user->profile_image) }}" alt="Profile Image" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;">
                        @else
                        No Image
                        @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>   
</body>
</html>
