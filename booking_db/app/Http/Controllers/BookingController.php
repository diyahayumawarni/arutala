<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Booking;

class BookingController extends Controller
{
    // Tampilkan daftar semua booking
    public function index()
    {
        $bookings = Booking::orderBy('created_at', 'desc')->get();
        return view('bookings.index', compact('bookings'));
    }

    // Tampilkan form tambah booking
    public function create()
    {
        // Ambil token dari file .env
        $token = env('ROOM_SERVICE_TOKEN');

        // Hapus blok try-catch sementara untuk melihat error yang sebenarnya
        $response = Http::withToken($token)
                             ->get(env('ROOM_SERVICE_URL') . '/api/rooms');

        // Pastikan respons sukses sebelum mengambil JSON
        if (!$response->successful()) {
            // Jika tidak sukses, Laravel akan melempar exception di sini
            // atau Anda bisa melempar exception kustom untuk debugging
            $response->throw(); // Ini akan melempar exception jika status kode bukan 2xx
        }

        $rooms = $response->json();

        return view('bookings.create', compact('rooms'));
    }

    // Tampilkan detail satu booking (fitur show)
    public function show(Booking $booking)
    {
        return view('bookings.show', compact('booking'));
    }

    // Tampilkan form edit booking
    public function edit(Booking $booking)
    {
        return view('bookings.edit', compact('booking'));
    }

    // ✨ Metode store() yang telah diperbarui dengan validasi bentrok ✨
    public function store(Request $request)
    {
        // Validasi data input
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'user_id' => 'required|integer',
            'room_id' => 'required|integer',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after_or_equal:start_time',
        ]);

        // Mulai logika validasi bentrok
        $isConflict = Booking::where('room_id', $validatedData['room_id'])
            ->where(function ($query) use ($validatedData) {
                // Cek apakah ada jadwal lama yang tumpang tindih dengan jadwal baru
                $query->whereBetween('start_time', [$validatedData['start_time'], $validatedData['end_time']])
                      ->orWhereBetween('end_time', [$validatedData['start_time'], $validatedData['end_time']])
                      ->orWhere(function ($query) use ($validatedData) {
                          $query->where('start_time', '<=', $validatedData['start_time'])
                                ->where('end_time', '>=', $validatedData['end_time']);
                      });
            })
            ->exists();

        if ($isConflict) {
            // Jika ditemukan jadwal bentrok, kembalikan dengan pesan error
            return back()->withErrors(['schedule_conflict' => 'Ruangan tidak tersedia pada jadwal yang dipilih karena sudah dibooking.'])
                         ->withInput();
        }

        // Jika tidak ada bentrok, lanjutkan proses penyimpanan
        Booking::create($validatedData);

        return redirect()->route('bookings.index')->with('success', 'Booking berhasil ditambahkan.');
    }


    // Simpan perubahan booking
    public function update(Request $request, Booking $booking)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'user_id' => 'required|integer',
            'room_id' => 'required|integer',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after_or_equal:start_time',
        ]);

        $booking->update($request->all());

        return redirect()->route('bookings.index')->with('success', 'Booking berhasil diperbarui.');
    }

    // Hapus booking
    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('bookings.index')->with('success', 'Booking berhasil dihapus.');
    }
}
