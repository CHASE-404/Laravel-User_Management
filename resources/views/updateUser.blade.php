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
<body>
    <header>
        <div class="container">
            <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
                <span class="d-flex align-items-center mb-3 mb-md-0 me-md-auto fs-4">User Management System</span>
                <ul class="nav nav-pills">
                    <li class="nav-item"><a href="/" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="/addUser" class="nav-link">Add Account</a></li>
                    <li class="nav-item"><a href="/deleteUser" class="nav-link">Delete Account</a></li>
                    <li class="nav-item"><a href="/updateUser" class="nav-link active">Update Account</a></li>
                </ul>
            </header>
        </div>
    </header>

    <div class="container mt-5">
        <h4>Update User Accounts</h4>
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

        <!-- Table of Users -->
        <table class="table">
            <thead>
                <tr>
                    <th>Select</th>
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
                        <td><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#updateModal" data-id="{{ $user->id }}" data-first_name="{{ $user->first_name }}" data-last_name="{{ $user->last_name }}" data-email="{{ $user->email }}" data-phone_number="{{ $user->phone_number }}" data-profile_image="{{ $user->profile_image }}">Edit</button></td>
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

    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Update User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="updateForm" action="{{ route('users.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="userId" name="user_id">
                        <div class="mb-3">
                            <label for="firstName" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="firstName" name="first_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="lastName" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="lastName" name="last_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="phoneNumber" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="phoneNumber" name="phone_number" required>
                        </div>
                        <div class="mb-3">
                            <label for="profileImage" class="form-label">Profile Image</label>
                            <input type="file" class="form-control" id="profileImage" name="profile_image">
                            <img id="currentProfileImage" src="" alt="Current Profile Image" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; margin-top: 10px;">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        // JavaScript to populate the modal with user data
        document.addEventListener('DOMContentLoaded', function () {
            var updateModal = document.getElementById('updateModal');
            updateModal.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget;
                var id = button.getAttribute('data-id');
                var firstName = button.getAttribute('data-first_name');
                var lastName = button.getAttribute('data-last_name');
                var email = button.getAttribute('data-email');
                var phoneNumber = button.getAttribute('data-phone_number');
                var profileImage = button.getAttribute('data-profile_image');

                var modal = updateModal.querySelector('form');
                modal.querySelector('#userId').value = id;
                modal.querySelector('#firstName').value = firstName;
                modal.querySelector('#lastName').value = lastName;
                modal.querySelector('#email').value = email;
                modal.querySelector('#phoneNumber').value = phoneNumber;

                var profileImagePath = "{{ asset('storage/') }}" + "/" + profileImage;
                var currentProfileImage = document.getElementById('currentProfileImage');
                if (profileImage) {
                    currentProfileImage.src = profileImagePath;
                    currentProfileImage.style.display = 'block';
                } else {
                    currentProfileImage.style.display = 'none';
                }
            });
        });

        // Confirm update before submitting
        document.querySelector('#updateForm').addEventListener('submit', function (event) {
            if (!confirm('Are you sure you want to update this user?')) {
                event.preventDefault();
            }
        });
    </script>
</body>
</html>
