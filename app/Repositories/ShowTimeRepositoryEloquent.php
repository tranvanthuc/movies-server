<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ShowTimeRepository;
use App\Entities\ShowTime;
use App\Validators\ShowTimeValidator;

/**
 * Class ShowTimeRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ShowTimeRepositoryEloquent extends BaseRepository implements ShowTimeRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ShowTime::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
