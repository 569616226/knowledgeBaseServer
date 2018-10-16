<?php

namespace App\Containers\Nav\Tasks;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Nav\Data\Repositories\NavRepository;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class DeleteNavTask extends Task
{

    private $repository;

    public function __construct(NavRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id)
    {
        $nav = Apiato::call('Nav@FindNavByIdTask', [$id]);

        if (!$nav->children->isEmpty()) {//不能删除有子分类的分类

            return simple_respone(false,'不能删除有子分类的分类');

        } else {

            try {
                \DB::beginTransaction();

                $nav->guests()->detach();//脱离关系

                $delete = $this->repository->delete($id);

                \DB::commit();

                return simple_respone($delete);

            } catch (Exception $exception) {

                \DB::rollback();

                report($exception);
                throw new DeleteResourceFailedException();
            }
        }

    }
}
