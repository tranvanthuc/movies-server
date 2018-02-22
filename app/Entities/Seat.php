<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Seat.
 *
 * @package namespace App\Entities;
 */
class Seat extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['room_id', 'type_seat_id', 'name', 'status'];

    public function typeSeat()
    {
        return $this->belongsTo(TypeSeat::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
