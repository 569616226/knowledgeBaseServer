<?php

namespace App\Containers\Answer\Tasks;

use App\Containers\Answer\Data\Repositories\AnswerRepository;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class DeleteAnswerTask extends Task
{

    private $repository;

    public function __construct(AnswerRepository $repository)
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
