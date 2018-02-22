<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ReceiptTicketRepository;
use App\Entities\ReceiptTicket;
use App\Validators\ReceiptTicketValidator;

/**
 * Class ReceiptTicketRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ReceiptTicketRepositoryEloquent extends BaseRepository implements ReceiptTicketRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ReceiptTicket::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
