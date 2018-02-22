<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\TypeSeatRepository;
use App\Entities\TypeSeat;
use App\Validators\TypeSeatValidator;

/**
 * Class TypeSeatRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class TypeSeatRepositoryEloquent extends BaseRepository implements TypeSeatRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return TypeSeat::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
