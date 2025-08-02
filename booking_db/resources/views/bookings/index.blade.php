<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Booking Ruang Rapat</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 40px;
            background: linear-gradient(to right, #4facfe, #00f2fe);
            color: #333;
        }

        .container {
            max-width: 1100px;
            margin: auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        h1 {
            text-align: center;
            color: #0077ff;
            margin-bottom: 30px;
        }

        a.button {
            display: inline-block;
            background-color: #0077ff;
            color: white;
            padding: 12px 20px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            margin-bottom: 20px;
            transition: 0.3s;
        }

        a.button:hover {
            background-color: #005fd1;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            padding: 12px 16px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: #f0f8ff;
            color: #0077ff;
        }

        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 6px;
        }

        .btn-detail, .btn-edit, .btn-delete {
            padding: 8px 14px;
            border-radius: 6px;
            font-size: 14px;
            text-decoration: none;
            font-weight: 500;
        }

        .btn-detail {
            background-color: #17a2b8;
            color: white;
        }

        .btn-edit {
            background-color: #ffc107;
            color: black;
        }

        .btn-delete {
            background-color: #dc3545;
            color: white;
            border: none;
        }

        .btn-detail:hover {
            background-color: #138496;
        }

        .btn-edit:hover {
            background-color: #e0a800;
        }

        .btn-delete:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Daftar Booking Ruang Rapat</h1>

    <a href="{{ route('bookings.create') }}" class="button">+ Tambah Booking</a>

    @if($bookings->count() > 0)
    <table>
        <thead>
            <tr>
                <th>Judul</th>
                <th>Waktu</th>
                <th>Room ID</th>
                <th>User ID</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bookings as $booking)
            <tr>
                <td>{{ $booking->title }}</td>
                <td>{{ $booking->start_time }} - {{ $booking->end_time }}</td>
                <td>{{ $booking->room_id }}</td>
                <td>{{ $booking->user_id }}</td>
                <td>
                    <div class="action-buttons">
                        <a href="{{ route('bookings.show', $booking->id) }}" class="btn-detail">Detail</a>
                        <a href="{{ route('bookings.edit', $booking->id) }}" class="btn-edit">Edit</a>
                        <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
        <p style="text-align: center; font-weight: bold; color: #666;">Tidak ada data booking.</p>
    @endif
</div>

</body>
</html>
