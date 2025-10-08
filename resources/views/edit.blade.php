<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        .error {
            color: red;
            font-size: 0.875rem;
        }

        .profile-img {
            border-radius: 8px;
            max-width: 120px;
            max-height: 120px;
            margin-bottom: 10px;
        }

        .form-range-value {
            font-weight: 500;
        }
    </style>
</head>

<body>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow">
                    <div class="card-header text-white bg-primary">
                        <h3 class="mb-0">Edit Employee</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('edit/' . $user->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Name & Email -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Name</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                                        <input type="text" class="form-control" name="name"
                                            value="{{ old('name', $user->name) }}">
                                    </div>
                                    @error('name')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                                        <input type="email" class="form-control" name="email"
                                            value="{{ old('email', $user->email) }}">
                                    </div>
                                    @error('email')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- DOB & Age -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">DOB</label>
                                    <input type="date" class="form-control" name="dob"
                                        value="{{ old('dob', $user->dob) }}">
                                    @error('dob')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Age</label>
                                    <input type="number" class="form-control" name="age"
                                        value="{{ old('age', $user->age) }}">
                                    @error('age')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- City & Gender -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">City</label>
                                    <select class="form-select" name="city">
                                        <option value="">--Select City--</option>
                                        <option value="surat"
                                            {{ old('city', $user->city) == 'surat' ? 'selected' : '' }}>Surat</option>
                                        <option value="vapi"
                                            {{ old('city', $user->city) == 'vapi' ? 'selected' : '' }}>Vapi</option>
                                        <option value="ahemdabad"
                                            {{ old('city', $user->city) == 'ahemdabad' ? 'selected' : '' }}>Ahemdabad
                                        </option>
                                    </select>
                                    @error('city')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Gender</label>
                                    <div class="d-flex gap-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gender" value="male"
                                                {{ old('gender', $user->gender) == 'male' ? 'checked' : '' }}>
                                            <label class="form-check-label">Male</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gender" value="female"
                                                {{ old('gender', $user->gender) == 'female' ? 'checked' : '' }}>
                                            <label class="form-check-label">Female</label>
                                        </div>
                                    </div>
                                    @error('gender')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Hobbies -->
                            <div class="mb-3">
                                <label class="form-label">Hobbies</label>
                                @php $hobbies = old('hobby', $user->hobby ? explode(',', $user->hobby) : []); @endphp
                                <div class="d-flex gap-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="hobby[]" value="reading"
                                            {{ in_array('reading', $hobbies) ? 'checked' : '' }}>
                                        <label class="form-check-label">Reading</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="hobby[]" value="music"
                                            {{ in_array('music', $hobbies) ? 'checked' : '' }}>
                                        <label class="form-check-label">Music</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="hobby[]" value="sports"
                                            {{ in_array('sports', $hobbies) ? 'checked' : '' }}>
                                        <label class="form-check-label">Sports</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="hobby[]"
                                            value="traveling" {{ in_array('traveling', $hobbies) ? 'checked' : '' }}>
                                        <label class="form-check-label">Traveling</label>
                                    </div>
                                </div>
                                @error('hobby')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Salary -->
                            <div class="mb-3">
                                <label class="form-label">Salary: <span
                                        class="form-range-value">{{ old('salary', $user->salary) }}</span></label>
                                <input type="range" class="form-range" min="10000" max="100000"
                                    step="1000" name="salary" oninput="salaryValue.innerText = this.value"
                                    value="{{ old('salary', $user->salary) }}">
                                <p>Selected Salary: <span id="salaryValue">{{ $user->salary }}</span></p>
                                @error('salary')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Address -->
                            <div class="mb-3">
                                <label class="form-label">Address</label>
                                <textarea class="form-control" name="address" rows="3">{{ old('address', $user->address) }}</textarea>
                                @error('address')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Profile -->
                            <div class="mb-3">
                                <label class="form-label">Profile Image</label><br>
                                @if ($user->profile)
                                    <img src="{{ asset('storage/' . $user->profile) }}" class="profile-img"
                                        alt="Profile">
                                @endif
                                <input class="form-control" type="file" name="profile">
                                @error('profile')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Buttons -->
                            <div class="d-flex gap-3">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{ url('/display') }}" class="btn btn-secondary">Cancel</a>
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
