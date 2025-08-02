<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Booking</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-100 text-gray-800">

    <div class="max-w-md mx-auto mt-10 bg-white p-6 rounded-xl shadow-md">
        <h1 class="text-2xl font-bold mb-6 text-center text-blue-700">Tambah Booking</h1>

        {{-- Tampilkan pesan error jika ada --}}
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('bookings.store') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block font-medium text-sm text-gray-700">Pilih Ruangan</label>
                <select name="room_id" required
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2">
                    <option value="">-- Pilih Ruangan --</option>
                    @foreach ($rooms as $room)
                        <option value="{{ $room['id'] }}" {{ old('room_id') == $room['id'] ? 'selected' : '' }}>
                            {{ $room['name'] }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
    <label class="block font-medium text-sm text-gray-700">Judul Booking</label>
    <input type="text" name="title" value="{{ old('title') }}" required
        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2">
</div>

            <div>
                <label class="block font-medium text-sm text-gray-700">User ID</label>
                <input type="number" name="user_id" value="{{ old('user_id') }}" required
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2">
            </div>

            <div>
                <label class="block font-medium text-sm text-gray-700">Waktu Mulai</label>
                <input type="datetime-local" name="start_time" value="{{ old('start_time') }}" required
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2">
            </div>

            <div>
                <label class="block font-medium text-sm text-gray-700">Waktu Selesai</label>
                <input type="datetime-local" name="end_time" value="{{ old('end_time') }}" required
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2">
            </div>

            <div class="flex justify-between items-center mt-6">
                <a href="{{ route('bookings.index') }}"
                   class="text-blue-600 hover:underline text-sm">← Kembali</a>

                <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                    Simpan
                </button>
            </div>
        </form>
    </div>

</body>
</html>
