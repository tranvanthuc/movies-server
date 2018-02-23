<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Schedule.
 *
 * @package namespace App\Entities;
 */
class Schedule extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['movie_id', 'room_id', 'showtime_id', 'show_date'];

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function showtime()
    {
        return $this->belongsTo(ShowTime::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
