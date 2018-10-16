<?php

namespace App\Containers\Advert\Tasks;

use App\Containers\Advert\Data\Criterias\ReaderStatusCriteria;
use App\Containers\Advert\Data\Repositories\AdvertRepository;
use App\Ship\Parents\Tasks\Task;

class GetAllAdvertsTask extends Task
{

    private $repository;

    public function __construct(AdvertRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run()
    {
        return $this->repository->all();
    }

    public function ordered()
    {
        return $this->repository->pushCriteria(new ReaderStatusCriteria());
    }
}
