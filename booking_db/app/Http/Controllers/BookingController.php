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
    try {
        $response = Http::get('http://room-service-nginx/api/rooms');
        $rooms = $response->successful() ? $response->json() : [];
    } catch (\Exception $e) {
        $rooms = [];
    }

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

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'user_id' => 'required|integer',
            'room_id' => 'required|integer',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after_or_equal:start_time',
        ]);

        Booking::create($request->all());

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
