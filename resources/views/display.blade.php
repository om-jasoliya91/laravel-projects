<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        table.table thead th {
            background-color: #4040fc;
            color: white;
            text-align: center;
            vertical-align: middle;
        }

        table.table tbody td {
            vertical-align: middle;
            text-align: center;
        }

        table.table tbody tr:hover {
            background-color: #f0f0f5;
            transition: background-color 0.3s ease;
        }

        table.table tbody td img {
            border-radius: 8px;
            object-fit: cover;
            max-height: 100px;
        }

        button.btn-delete {
            font-weight: 500;
            padding: 8px 20px;
            border-radius: 6px;
            transition: all 0.3s ease;
            background-color: #dc3545;
        }

        button.btn-delete:hover {

            color: white;
            background-color: #db2638;
        }

        a.btn-edit {
            padding: 4px 10px;
            font-size: 0.85rem;
        }

        input.form-check-input {
            transform: scale(1.2);
        }

        .table-responsive {
            max-height: 600px;
            overflow-y: auto;
        }

        table.table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table.table tbody tr:nth-child(odd) {
            background-color: #ffffff;
        }
    </style>
</head>

<body>
    <div class="container my-5">
        <form action="{{ route('users.deleteMultiple') }}" method="POST">
            @csrf
            @method('DELETE')
            <p class="mb-3 text-left"><a href="{{ route('logout') }}" class="btn btn-outline-danger  ">Logout</a></p>

            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead>
                        <tr>
                            <th>Select</th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>DOB</th>
                            <th>Age</th>
                            <th>City</th>
                            <th>Gender</th>
                            <th>Hobby</th>
                            <th>Salary</th>
                            <th>Address</th>
                            <th>Profile</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td>
                                    <input class="form-check-input" type="checkbox" name="user_ids[]"
                                        value="{{ $user->id }}">
                                </td>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->dob }}</td>
                                <td>{{ $user->age }}</td>
                                <td>{{ ucfirst($user->city) }}</td>
                                <td>{{ ucfirst($user->gender) }}</td>
                                <td>{{ $user->hobby }}</td>
                                <td>{{ $user->salary }}</td>
                                <td>{{ $user->address }}</td>
                                <td>
                                    @if ($user->profile)
                                        <img src="{{ asset('storage/' . $user->profile) }}" class="img-thumbnail"
                                            alt="Profile">
                                    @else
                                        <span class="text-muted">No Image</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ url('edit', $user->id) }}"
                                        class="btn btn-sm btn-primary btn-edit">Edit</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="13" class="text-center text-danger">No Records Found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <button class="btn btn-danger btn-delete mt-3" type="submit"
                onclick="return confirm('Are you sure you want to delete selected users?')">
                Delete Selected
            </button>


        </form>
    </div>
</body>

</html>
