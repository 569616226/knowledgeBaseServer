<?php

namespace App\Containers\User\Tasks;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\User\Data\Repositories\UserRepository;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class FrozenAdminTask extends Task
{

    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id)
    {
        try {

            $admin = Apiato::call('User@FindUserByIdTask', [$id]);

            return $this->repository->update(['is_frozen' => !$admin->is_frozen], $id);
        } catch (Exception $exception) {
            throw new NotFoundException();
        }
    }
}
