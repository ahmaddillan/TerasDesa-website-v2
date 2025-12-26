<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Login - TerasDesa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background:#95B67F">

    <div class="container vh-100 d-flex justify-content-center align-items-center">
        <div class="card shadow p-4" style="max-width:380px;width:100%;border-radius:20px;">
            <h3 class="text-center fw-bold mb-4">Login</h3>

            @if (session('error'))
                <div class="alert alert-danger text-center">{{ session('error') }}</div>
            @endif

            @if (session('success'))
                <div class="alert alert-success text-center">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="/login">
                @csrf
                <div class="mb-3">
                    <label class="fw-semibold">Email</label>
                    <input type="email" name="email" class="form-control bg-light" required>
                </div>

                <div class="mb-4">
                    <label class="fw-semibold">Password</label>
                    <input type="password" name="password" class="form-control bg-light" required>
                </div>

                <button class="btn w-100 text-white fw-bold" style="background:#6B8E23">Login</button>
            </form>

            <div class="text-center mt-3">
                Don't have an account? <a href="/register" class="fw-bold text-success">Sign Up</a>
            </div>
        </div>
    </div>

</body>

</html>
