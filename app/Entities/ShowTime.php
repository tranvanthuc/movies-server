<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class ShowTime.
 *
 * @package namespace App\Entities;
 */
class ShowTime extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['start_time', 'end_time'];

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}