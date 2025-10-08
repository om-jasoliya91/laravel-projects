<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<body>
    <div class="container my-5" style="width: 500px">
        <div class="card shadow p-3">   
            <div class="card-header text-primary text-center">
                <h2>Login Form</h2>
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
            </div>
            <form action="login" method="post">
                @csrf
                <div class="mb-3 p-2">
                    <label for="email">Email:</label>
                    <input type="email" name="email" class="form-control border-2" placeholder="Enter Your Email:">
                </div>
                <div class="mb-3 p-2">
                    <label for="password">Password:</label>
                    <input type="password" name="password" class="form-control border-2"
                        placeholder="Enter Your Password:">
                </div>
                <div class="d-grid">
                    <input type="submit" value="Login" class="btn btn-outline-primary">
                </div>
            </form>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</html>
