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
                <label for="room_id" class="block font-medium text-sm text-gray-700">Pilih Ruangan</label>
                <select name="room_id" id="room_id" required
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2">
                    <option value="">-- Pilih Ruangan --</option>
                    @foreach ($rooms as $room)
                        <option value="{{ $room['id'] }}" {{ old('room_id') == $room['id'] ? 'selected' : '' }}
                            data-capacity="{{ $room['capacity'] }}"
                            data-facilities="{{ $room['facilities'] }}">
                            {{ $room['name'] }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Elemen baru untuk menampilkan detail ruangan --}}
            <div id="room-details" class="p-4 bg-gray-50 rounded-lg shadow-inner" style="display: none;">
                <p class="text-sm">
                    <span class="font-semibold text-gray-600">Kapasitas:</span>
                    <span id="room-capacity" class="text-gray-900"></span>
                </p>
                <p class="text-sm mt-2">
                    <span class="font-semibold text-gray-600">Fasilitas:</span>
                    <span id="room-facilities" class="text-gray-900"></span>
                </p>
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

    {{-- Script untuk menangani tampilan detail ruangan secara dinamis --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const roomSelect = document.getElementById('room_id');
            const roomDetails = document.getElementById('room-details');
            const roomCapacity = document.getElementById('room-capacity');
            const roomFacilities = document.getElementById('room-facilities');

            // Fungsi untuk menampilkan detail ruangan
            function showRoomDetails() {
                const selectedOption = roomSelect.options[roomSelect.selectedIndex];
                const capacity = selectedOption.getAttribute('data-capacity');
                const facilities = selectedOption.getAttribute('data-facilities');

                if (capacity && facilities) {
                    roomCapacity.textContent = capacity;
                    roomFacilities.textContent = facilities;
                    roomDetails.style.display = 'block';
                } else {
                    roomDetails.style.display = 'none';
                    roomCapacity.textContent = '';
                    roomFacilities.textContent = '';
                }
            }

            // Panggil fungsi saat halaman dimuat (untuk kasus old('room_id'))
            showRoomDetails();

            // Tambahkan event listener untuk perubahan pada dropdown
            roomSelect.addEventListener('change', showRoomDetails);
        });
    </script>

</body>
</html>
