<?php

namespace App\Containers\Topic\Tasks;

use App\Containers\Topic\Data\Repositories\TopicRepository;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Illuminate\Support\Facades\Cache;

class CreateTopicTask extends Task
{

    private $repository;

    public function __construct(TopicRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(array $data)
    {

        try {
            Cache::forget('topic_article_answers');

            return $this->repository->create($data);
        } catch (Exception $exception) {
            report($exception);
            throw new CreateResourceFailedException();
        }
    }
}
