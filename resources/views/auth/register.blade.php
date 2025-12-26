<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register - TerasDesa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background:#95B67F">

<div class="container vh-100 d-flex justify-content-center align-items-center">
    <div class="card shadow p-4" style="max-width:380px;width:100%;border-radius:20px;">
        <h3 class="text-center fw-bold mb-4">Sign Up</h3>

        <form method="POST" action="/register">
            @csrf
            <div class="mb-3">
                <label class="fw-semibold">Full Name</label>
                <input type="text" name="name" class="form-control bg-light" required>
            </div>

            <div class="mb-3">
                <label class="fw-semibold">Email</label>
                <input type="email" name="email" class="form-control bg-light" required>
            </div>

            <div class="mb-3">
                <label class="fw-semibold">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="form-control bg-light" required>
            </div>

            <div class="mb-3">
                <label class="fw-semibold">No HP</label>
                <input type="text" name="no_hp" class="form-control bg-light" required>
            </div>

            <div class="mb-4">
                <label class="fw-semibold">Password</label>
                <input type="password" name="password" class="form-control bg-light" required>
            </div>

            <button class="btn w-100 text-white fw-bold"
                style="background:#6B8E23">Register</button>
        </form>

        <div class="text-center mt-3">
            Already have an account? <a href="/login" class="fw-bold text-success">Login</a>
        </div>
    </div>
</div>

</body>
</html>
