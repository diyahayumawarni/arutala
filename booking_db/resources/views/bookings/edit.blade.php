<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Booking</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-100 text-gray-800 min-h-screen flex items-center justify-center">

    <div class="w-full max-w-xl bg-white rounded-xl shadow-xl p-8 border border-blue-200">
        <h1 class="text-3xl font-bold text-blue-800 mb-6 text-center">Edit Booking</h1>

        <form action="{{ route('bookings.update', $booking->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <!-- Judul Booking -->
            <div>
                <label for="title" class="block font-semibold text-blue-700">Judul Booking</label>
                <input type="text" id="title" name="title"
                       value="{{ old('title', $booking->title) }}"
                       class="w-full p-2 mt-1 border rounded-lg focus:ring-2 focus:ring-blue-400 @error('title') border-red-500 @enderror">
                @error('title')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- User ID -->
            <div>
                <label for="user_id" class="block font-semibold text-blue-700">User ID</label>
                <input type="number" id="user_id" name="user_id"
                       value="{{ old('user_id', $booking->user_id) }}"
                       class="w-full p-2 mt-1 border rounded-lg focus:ring-2 focus:ring-blue-400 @error('user_id') border-red-500 @enderror">
                @error('user_id')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Room ID -->
            <div>
                <label for="room_id" class="block font-semibold text-blue-700">Room ID</label>
                <input type="number" id="room_id" name="room_id"
                       value="{{ old('room_id', $booking->room_id) }}"
                       class="w-full p-2 mt-1 border rounded-lg focus:ring-2 focus:ring-blue-400 @error('room_id') border-red-500 @enderror">
                @error('room_id')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Waktu Mulai -->
            <div>
                <label for="start_time" class="block font-semibold text-blue-700">Waktu Mulai</label>
                <input type="datetime-local" id="start_time" name="start_time"
                       value="{{ old('start_time', \Carbon\Carbon::parse($booking->start_time)->format('Y-m-d\TH:i')) }}"
                       class="w-full p-2 mt-1 border rounded-lg focus:ring-2 focus:ring-blue-400 @error('start_time') border-red-500 @enderror">
                @error('start_time')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Waktu Selesai -->
            <div>
                <label for="end_time" class="block font-semibold text-blue-700">Waktu Selesai</label>
                <input type="datetime-local" id="end_time" name="end_time"
                       value="{{ old('end_time', \Carbon\Carbon::parse($booking->end_time)->format('Y-m-d\TH:i')) }}"
                       class="w-full p-2 mt-1 border rounded-lg focus:ring-2 focus:ring-blue-400 @error('end_time') border-red-500 @enderror">
                @error('end_time')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tombol Aksi -->
            <div class="flex justify-between items-center pt-4">
                <a href="{{ route('bookings.index') }}"
                   class="text-blue-700 hover:underline font-semibold">
                   ← Kembali
                </a>
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2 rounded-lg transition duration-200">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

</body>
</html>
