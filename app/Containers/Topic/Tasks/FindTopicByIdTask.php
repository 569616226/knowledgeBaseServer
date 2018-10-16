<?php

namespace App\Containers\Topic\Tasks;

use App\Containers\Topic\Data\Repositories\TopicRepository;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class FindTopicByIdTask extends Task
{

    private $repository;

    public function __construct(TopicRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id)
    {
        try {
            return $this->repository->find($id);
        } catch (Exception $exception) {
            report($exception);
            throw new NotFoundException();
        }
    }
}
