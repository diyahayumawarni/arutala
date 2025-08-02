<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Booking</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-[#f4f6f9] text-gray-800 min-h-screen">

    <div class="max-w-2xl mx-auto mt-14 bg-white p-8 rounded-lg shadow-lg border border-gray-200">
        <h1 class="text-3xl font-bold text-blue-700 mb-8 text-center">📋 Detail Booking</h1>

        <div class="grid grid-cols-1 gap-5">
            <div>
                <p class="text-sm text-gray-500">Judul:</p>
                <p class="text-lg font-semibold text-gray-900">{{ $booking->title }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500">User ID:</p>
                <p class="text-lg font-semibold text-gray-900">{{ $booking->user_id }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Room ID:</p>
                <p class="text-lg font-semibold text-gray-900">{{ $booking->room_id }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Waktu Mulai:</p>
                <p class="text-lg font-semibold text-gray-900">
                    {{ \Carbon\Carbon::parse($booking->start_time)->format('d M Y, H:i') }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Waktu Selesai:</p>
                <p class="text-lg font-semibold text-gray-900">
                    {{ \Carbon\Carbon::parse($booking->end_time)->format('d M Y, H:i') }}
                </p>
            </div>
        </div>

        <div class="mt-10 flex justify-between items-center">
            <a href="{{ route('bookings.index') }}" class="inline-block px-5 py-2 text-sm bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-md shadow">← Kembali</a>
            <a href="{{ route('bookings.edit', $booking->id) }}" class="inline-block px-5 py-2 text-sm bg-yellow-400 hover:bg-yellow-500 text-gray-800 rounded-md shadow">✏️ Edit</a>
        </div>
    </div>

</body>
</html>
