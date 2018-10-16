<?php

namespace App\Containers\Article\Tasks;


use App\Containers\Article\Data\Repositories\ArticleRepository;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Illuminate\Support\Facades\Cache;

class CreateArticleTask extends Task
{

    private $repository;

    public function __construct(ArticleRepository $repository)
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
