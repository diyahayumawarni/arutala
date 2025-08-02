<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang di Sistem Booking Ruang Rapat</title>

    {{-- Tambahkan baris ini untuk load Vite CSS dan JS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right, #4facfe, #00f2fe);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
        }

        .welcome-container {
            text-align: center;
            background-color: rgba(0,0,0,0.5);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }

        h1 {
            font-size: 36px;
            margin-bottom: 20px;
        }

        p {
            font-size: 18px;
            margin-bottom: 30px;
        }

        a.button {
            display: inline-block;
            background-color: #ffffff;
            color: #0077ff;
            padding: 14px 28px;
            font-size: 18px;
            border-radius: 8px;
            text-decoration: none;
            transition: 0.3s;
            font-weight: bold;
        }

        a.button:hover {
            background-color: #e0e0e0;
            color: #0054cc;
        }
    </style>
</head>
<body>
    <form method="POST" action="{{ route('keluar') }}" style="margin-top: 20px;">
        @csrf
        <button type="submit" class="button" style="background-color: #ff5252; color: white;">Logout</button>
    </form>

    <div class="welcome-container">
        <h1>Selamat Datang</h1>
        <p>Sistem Informasi Booking Ruang Rapat</p>
        <a href="{{ route('bookings.index') }}" class="button">Lihat Daftar Booking</a>
    </div>
</body>
</html>
