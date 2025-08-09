<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * @OA\Get(
     * path="/api/rooms",
     * operationId="getRoomsList",
     * tags={"Rooms"},
     * summary="Mendapatkan daftar semua ruangan",
     * description="Mengambil daftar semua data ruangan yang tersedia.",
     * @OA\Response(
     * response=200,
     * description="Berhasil mendapatkan daftar ruangan",
     * @OA\JsonContent(
     * type="array",
     * @OA\Items(ref="#/components/schemas/Room")
     * )
     * )
     * )
     */
    public function index()
    {
        return response()->json(Room::all());
    }

    /**
     * @OA\Post(
     * path="/api/rooms",
     * operationId="createRoom",
     * tags={"Rooms"},
     * summary="Membuat ruangan baru",
     * description="Menambahkan data ruangan baru ke database.",
     * @OA\RequestBody(
     * required=true,
     * @OA\JsonContent(ref="#/components/schemas/RoomStoreRequest")
     * ),
     * @OA\Response(
     * response=201,
     * description="Berhasil membuat ruangan",
     * @OA\JsonContent(ref="#/components/schemas/Room")
     * )
     * )
     */
    public function store(Request $request)
    {
        $room = Room::create($request->all());
        return response()->json($room, 201);
    }

    /**
     * @OA\Get(
     * path="/api/rooms/{id}",
     * operationId="getRoomById",
     * tags={"Rooms"},
     * summary="Mendapatkan detail satu ruangan",
     * description="Mengambil data ruangan berdasarkan ID.",
     * @OA\Parameter(
     * name="id",
     * description="ID ruangan",
     * required=true,
     * in="path",
     * @OA\Schema(type="integer")
     * ),
     * @OA\Response(
     * response=200,
     * description="Berhasil mendapatkan detail ruangan",
     * @OA\JsonContent(ref="#/components/schemas/Room")
     * ),
     * @OA\Response(
     * response=404,
     * description="Ruangan tidak ditemukan"
     * )
     * )
     */
    public function show($id)
    {
        $room = Room::findOrFail($id);
        return response()->json($room);
    }

    /**
     * @OA\Put(
     * path="/api/rooms/{id}",
     * operationId="updateRoom",
     * tags={"Rooms"},
     * summary="Memperbarui data ruangan",
     * description="Memperbarui data ruangan berdasarkan ID.",
     * @OA\Parameter(
     * name="id",
     * description="ID ruangan",
     * required=true,
     * in="path",
     * @OA\Schema(type="integer")
     * ),
     * @OA\RequestBody(
     * required=true,
     * @OA\JsonContent(ref="#/components/schemas/RoomStoreRequest")
     * ),
     * @OA\Response(
     * response=200,
     * description="Berhasil memperbarui data ruangan",
     * @OA\JsonContent(ref="#/components/schemas/Room")
     * ),
     * @OA\Response(
     * response=404,
     * description="Ruangan tidak ditemukan"
     * )
     * )
     */
    public function update(Request $request, $id)
    {
        $room = Room::findOrFail($id);
        $room->update($request->all());
        return response()->json($room);
    }

    /**
     * @OA\Delete(
     * path="/api/rooms/{id}",
     * operationId="deleteRoom",
     * tags={"Rooms"},
     * summary="Menghapus ruangan",
     * description="Menghapus data ruangan dari database berdasarkan ID.",
     * @OA\Parameter(
     * name="id",
     * description="ID ruangan",
     * required=true,
     * in="path",
     * @OA\Schema(type="integer")
     * ),
     * @OA\Response(
     * response=204,
     * description="Ruangan berhasil dihapus"
     * ),
     * @OA\Response(
     * response=404,
     * description="Ruangan tidak ditemukan"
     * )
     * )
     */
     public function destroy($id)
{
    // Cari ruangan berdasarkan ID, jika tidak ditemukan akan throw 404
    $room = Room::findOrFail($id);

    // Hapus ruangan dari database
    $room->delete();

    // Mengembalikan respons sukses (200) dengan pesan
    return response()->json(['message' => 'Ruangan berhasil dihapus'], 200);
}
}
