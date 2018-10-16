<?php

namespace App\Containers\Order\Tasks;

use App\Containers\Order\Data\Repositories\OrderRepository;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class ChangeOrderAuditStatusTask extends Task
{

    private $repository;

    public function __construct(OrderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id, array $data)
    {

        try {

            \DB::beginTransaction();

            $order = $this->repository->update($data, $id);

            /*审核通过，进入退款流程*/
            if ($order->refund_audit_status == 1) {

                if (wechat_return_order($order)) {

                    \DB::commit();

                    return true;

                }

            }else{

                /*
                 * 审核不通过，订单变为已完成
                 *
                 * */
                $this->repository->update(['status' => 5], $id);

                \DB::commit();

                return true;
            }

            \DB::rollBack();
            return false;

        } catch (Exception $exception) {

            \DB::rollBack();
            report($exception);
            throw new UpdateResourceFailedException();

        }
    }
}
