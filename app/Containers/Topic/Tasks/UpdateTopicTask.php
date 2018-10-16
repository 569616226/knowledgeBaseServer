<?php

namespace App\Containers\Topic\Tasks;

use App\Containers\Topic\Data\Repositories\TopicRepository;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Illuminate\Support\Facades\Cache;

class UpdateTopicTask extends Task
{

    private $repository;

    public function __construct(TopicRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id, array $data)
    {
        try {
            Cache::forget('topic_article_answers');
            return $this->repository->update($data, $id);
        } catch (Exception $exception) {
            report($exception);
            throw new UpdateResourceFailedException();
        }
    }
}
