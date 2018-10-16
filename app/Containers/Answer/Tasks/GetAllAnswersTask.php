<?php

namespace App\Containers\Answer\Tasks;


use App\Containers\Answer\Data\Repositories\AnswerRepository;
use App\Ship\Parents\Tasks\Task;

class GetAllAnswersTask extends Task
{

    private $repository;

    public function __construct(AnswerRepository $repository)
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
}


