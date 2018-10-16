<?php

namespace App\Containers\Topic\Tasks;

use App\Containers\Topic\Data\Repositories\TopicRepository;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class DeleteTopicTask extends Task
{

    private $repository;

    public function __construct(TopicRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id)
    {
        try {
            return $this->repository->delete($id);
        } catch (Exception $exception) {
            report($exception);
            throw new DeleteResourceFailedException();
        }
    }
}
