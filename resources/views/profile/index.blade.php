<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - TerasDesa</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            background: #f5f6fa;
            font-family: 'Poppins', sans-serif;
        }

        .header {
            background: rgb(255, 255, 255);
            padding: 15px 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, .08);
        }

        .profile-card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, .08);
        }

        .profile-photo {
            width: 160px;
            height: 160px;
            object-fit: cover;
            border-radius: 50%;
            border: 5px solid white;
            box-shadow: 0 5px 20px rgba(0, 0, 0, .1);
        }

        .btn-orange {
            background: #4a6b36;
            color: white;
            border: none;
        }

        .btn-orange:hover {
            background: #4a6b36;
            color: white;
        }
    </style>

</head>

<body>

    <header class="header">

        <div class="container d-flex justify-content-between align-items-center">

            <h3 class="mb-0">
                🏠 TerasDesa
            </h3>

            <a href="{{ url('/') }}" class="btn btn-outline-secondary">

                Kembali

            </a>

        </div>

    </header>



    <div class="container py-5">

        @if (session('success'))
            <div class="alert alert-success">

                {{ session('success') }}

            </div>
        @endif


        @if (session('error'))
            <div class="alert alert-danger">

                {{ session('error') }}

            </div>
        @endif



        <div class="row g-4">


            {{-- FOTO PROFIL --}}

            <div class="col-md-4">

                <div class="card profile-card">

                    <div class="card-body text-center">


                        @if (!empty($user['photo']))
                            <img src="{{ env('EXPRESS_API') . '/' . $user['photo'] }}" class="profile-photo mb-3">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ $user['name'] }}&size=160"
                                class="profile-photo mb-3">
                        @endif


                        <h4>

                            {{ $user['name'] }}

                        </h4>


                        <p class="text-muted">

                            {{ ucfirst($user['role']) }}

                        </p>


                        <form action="{{ route('profile.photo') }}" method="POST" enctype="multipart/form-data">

                            @csrf

                            <input type="file" name="photo" class="form-control mb-3">


                            <button type="submit" class="btn btn-orange w-100">

                                Upload Foto

                            </button>

                        </form>


                    </div>

                </div>

            </div>




            {{-- DATA PROFIL --}}

            <div class="col-md-8">

                <div class="card profile-card">

                    <div class="card-body">

                        <h3 class="mb-4">

                            Profil Saya

                        </h3>


                        <form action="{{ route('profile.update') }} "method="POST">
                            @csrf
                            <div class="mb-3">

                                <label class="form-label">
                                    Nama

                                </label>

                                <input type="text" name="name" class="form-control" value="{{ $user['name'] }}">

                            </div>



                            <div class="mb-3">

                                <label class="form-label">

                                    Email

                                </label>

                                <input type="email" class="form-control" value="{{ $user['email'] }}" readonly>

                            </div>



                            <div class="mb-3">

                                <label class="form-label">

                                    Tanggal Lahir

                                </label>

                                <input type="date" class="form-control" value="{{ $user['tanggal_lahir'] }}"
                                    readonly>

                            </div>



                            <div class="mb-3">

                                <label class="form-label">

                                    No HP

                                </label>

                                <input type="text" name="no_hp" class="form-control" value="{{ $user['no_hp'] }}">

                            </div>



                            <div class="mb-3">

                                <label class="form-label">

                                    Role

                                </label>

                                <input type="text" class="form-control" value="{{ ucfirst($user['role']) }}"
                                    readonly>

                            </div>



                            <button type="submit" class="btn btn-orange">

                                Simpan Perubahan

                            </button>

                        </form>

                    </div>

                </div>

            </div>


        </div>

    </div>

</body>

</html>
