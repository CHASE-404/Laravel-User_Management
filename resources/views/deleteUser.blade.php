<!DOCTYPE html>
<html>
<head>
    <title>Delete User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<header>
  <div class="container">
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
      <span class="d-flex align-items-center mb-3 mb-md-0 me-md-auto fs-4">User Management System</span>
      <ul class="nav nav-pills">
        <li class="nav-item"><a href="/" class="nav-link">Home</a></li>
        <li class="nav-item"><a href="/addUser" class="nav-link">Add Account</a></li>
        <li class="nav-item"><a href="/deleteUser" class="nav-link active">Delete Account</a></li>
        <li class="nav-item"><a href="/updateUser" class="nav-link">Update Account</a></li>
      </ul>
    </header>
  </div>
</header>

<body>
    <div class="container mt-5">   
    <h4>Delete User Accounts</h4>
    @if (session('success'))
     <div class="alert alert-success alert-dismissible fade show" role="alert">
     {{ session('success') }}
     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>    
    @endif  
    @if (session('error'))    
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <form action="{{ route('users.delete') }}" method="POST" onsubmit="return confirm('Are you sure you want to delete the selected users?');">
        @csrf
        <table class="table">
            <thead>
                <tr>
                    <th>Select</th>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Phone Number</th>
                    <th>Profile Image</th>
                </tr>
            </thead>
            <tbody>          
                @foreach ($users as $user)
                <tr>        
                <td><input type="checkbox" name="user_ids[]" value="{{ $user->id }}"></td>     
                <td>{{ $user->id }}</td>
                <td>{{ $user->first_name }}</td>    
                <td>{{ $user->last_name }}</td>       
                <td>{{ $user->email }}</td>                       
                <td>{{ $user->password }}</td>                       
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
        <button type="submit" class="btn btn-danger">Delete Selected Users</button>
    </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        
    document.addEventListener('DOMContentLoaded', function () {
        setTimeout(function() {  
        var alerts = document.querySelectorAll('.alert'); 
        alerts.forEach(function(alert) {
            alert.classList.remove('show');
            alert.classList.add('fade');
        });
    }, 3000);
    });
    </script>
</body>
</html>
