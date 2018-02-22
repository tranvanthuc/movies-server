<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Movie.
 *
 * @package namespace App\Entities;
 */
class Movie extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['genre_id', 'title', 'overview', 'background_path', 'poster_path', 'trailer', 'producer', 'release_date', 'runtime', 'language'];

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

}
