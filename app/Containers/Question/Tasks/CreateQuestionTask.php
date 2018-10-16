<?php

namespace App\Containers\Question\Tasks;

use App\Containers\Question\Data\Repositories\QuestionRepository;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class CreateQuestionTask extends Task
{

    private $repository;

    public function __construct(QuestionRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(array $data)
    {

        try {
            return $this->repository->create($data);
        } catch (Exception $exception) {
            report($exception);
            throw new CreateResourceFailedException();
        }
    }
}
