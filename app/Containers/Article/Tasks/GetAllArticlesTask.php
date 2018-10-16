<?php

namespace App\Containers\Article\Tasks;

use App\Containers\Article\Data\Criterias\GetGuestArticlesCriteria;
use App\Containers\Article\Data\Repositories\ArticleRepository;
use App\Ship\Criterias\Eloquent\OrderByDescCriteria;
use App\Ship\Parents\Tasks\Task;

class GetAllArticlesTask extends Task
{

    private $repository;

    public function __construct(ArticleRepository $repository)
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

    public function guests()
    {
        return $this->repository->pushCriteria(new GetGuestArticlesCriteria());
    }

    public function order_by_updated_at()
    {
        return $this->repository->pushCriteria(new OrderByDescCriteria('updated_at'));
    }

}
