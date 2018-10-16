<?php

namespace App\Containers\Order\Tasks;

use App\Containers\Order\Data\Criterias\AnswersCriteria;
use App\Containers\Order\Data\Criterias\AppointsCriteria;
use App\Containers\Order\Data\Criterias\CancelsCriteria;
use App\Containers\Order\Data\Criterias\CasesCriteria;
use App\Containers\Order\Data\Criterias\RefundsCriteria;
use App\Containers\Order\Data\Repositories\OrderRepository;
use App\Ship\Criterias\Eloquent\OrderByCreationDateDescendingCriteria;
use App\Ship\Parents\Tasks\Task;

class GetAllOrdersTask extends Task
{

    private $repository;

    public function __construct(OrderRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param bool $skipPagination
     *
     * @return  mixed
     */
    public function run($skipPagination = false)
    {
        return $skipPagination ? $this->repository->all() : $this->repository->paginate();
    }

    public function answers()
    {
        $this->repository->pushCriteria(new AnswersCriteria());
    }

    public function appoints()
    {
        $this->repository->pushCriteria(new AppointsCriteria());
    }

    public function cancels()
    {
        $this->repository->pushCriteria(new CancelsCriteria());
    }

    public function ordered()
    {
        $this->repository->pushCriteria(new OrderByCreationDateDescendingCriteria());
    }

    public function refunds()
    {
        $this->repository->pushCriteria(new RefundsCriteria());
    }


    public function cases()
    {
        $this->repository->pushCriteria(new CasesCriteria());
    }

}
