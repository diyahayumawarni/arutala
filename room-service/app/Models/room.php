<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 * schema="Room",
 * title="Room",
 * description="Model data ruangan",
 * @OA\Property(property="id", type="integer", example=1),
 * @OA\Property(property="name", type="string", example="Ruang Serbaguna"),
 * @OA\Property(property="capacity", type="integer", example=50),
 * @OA\Property(property="facilities", type="string", example="AC, Proyektor")
 * )
 *
 * @OA\Schema(
 * schema="RoomStoreRequest",
 * title="RoomStoreRequest",
 * description="Request body untuk membuat/memperbarui ruangan",
 * @OA\Property(property="name", type="string", example="Ruang Serbaguna"),
 * @OA\Property(property="capacity", type="integer", example=50),
 * @OA\Property(property="facilities", type="string", example="AC, Proyektor")
 * )
 */
class Room extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'capacity',
        'facilities',
    ];
}
