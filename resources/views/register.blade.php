<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Employee</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<body>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white text-center">
                        <h3 class="mb-0">Employee Registration Form</h3>
                    </div>
                    <div class="card-body">

                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <form action="register" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Name:</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                                        <input type="text" name="name" class="form-control"
                                            placeholder="Enter your name">
                                    </div>
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Email:</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                                        <input type="email" name="email" class="form-control"
                                            placeholder="Enter your email">
                                    </div>
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Date of Birth:</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-calendar-date-fill"></i></span>
                                        <input type="date" name="dob" class="form-control">
                                    </div>
                                    @error('dob')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Age:</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-hourglass-split"></i></span>
                                        <input type="number" name="age" class="form-control"
                                            placeholder="Enter your age">
                                    </div>
                                    @error('age')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">City:</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-building"></i></span>
                                        <select name="city" class="form-select">
                                            <option value="">-- Select City --</option>
                                            <option value="surat">Surat</option>
                                            <option value="vapi">Vapi</option>
                                            <option value="ahemdabad">Ahmedabad</option>
                                        </select>
                                    </div>
                                    @error('city')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label d-block">Gender:</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" value="male">
                                        <label class="form-check-label"><i class="bi bi-person"></i> Male</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" value="female">
                                        <label class="form-check-label"><i class="bi bi-person-fill"></i> Female</label>
                                    </div>
                                    @error('gender')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label d-block">Hobbies:</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="hobby[]" value="reading">
                                        <label class="form-check-label"><i class="bi bi-book"></i> Reading</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="hobby[]"
                                            value="music">
                                        <label class="form-check-label"><i class="bi bi-music-note-beamed"></i>
                                            Music</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="hobby[]"
                                            value="sports">
                                        <label class="form-check-label"><i class="bi bi-trophy-fill"></i>
                                            Sports</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="hobby[]"
                                            value="traveling">
                                        <label class="form-check-label"><i class="bi bi-airplane-engines-fill"></i>
                                            Traveling</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Salary:</label>
                                    <input type="range" name="salary" class="form-range" min="10000"
                                        max="100000" step="1000" oninput="salaryValue.innerText = this.value">
                                    <p>Selected Salary: <span id="salaryValue">50000</span></p>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Password:</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                        <input type="password" name="password" class="form-control"
                                            placeholder="Enter password">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Confirm Password:</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                        <input type="password" name="cpassword" class="form-control"
                                            placeholder="Confirm password">
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Address:</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-house-fill"></i></span>
                                        <textarea name="address" class="form-control" rows="3" placeholder="Enter your address"></textarea>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Profile Picture:</label>
                                    <input type="file" name="profile" class="form-control">
                                </div>
                            </div>

                            <div class="d-flex justify-content-between">
                                <button type="submit" class="btn btn-success"><i class="bi bi-check-lg"></i>
                                    Submit</button>
                                <button type="reset" class="btn btn-secondary"><i
                                        class="bi bi-arrow-counterclockwise"></i> Reset</button>
                                <a href="{{ url('display') }}" class="btn btn-primary"><i class="bi bi-eye"></i> View
                                    Employees</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
