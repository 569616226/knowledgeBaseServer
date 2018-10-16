<?php

namespace App\Containers\Group\Tasks;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Group\Data\Repositories\GroupRepository;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class DeleteGroupTask extends Task
{

    private $repository;

    public function __construct(GroupRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id)
    {
        try {

            $group = Apiato::call('Group@FindGroupByIdTask', [$id]);
            $group->guests()->detach();

            return $this->repository->delete($id);

        } catch (Exception $exception) {

            report($exception);
            throw new DeleteResourceFailedException();
        }
    }
}
