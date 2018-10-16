<?php

namespace App\Containers\Order\Tasks;

use App\Containers\Order\Data\Repositories\OrderRepository;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class CreateOrderTask extends Task
{

    private $repository;

    public function __construct(OrderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(array $data)
    {

        try {

            $wechat_payment = wechat_payment($data['order_no'],$data['price']);

            if ($wechat_payment) {

               $order =  $this->repository->create($data);

                if($order){

                    return $wechat_payment;
                }

            }

            return simple_respone(false,'操作失败');

        } catch (Exception $exception) {

            report($exception);
            throw new CreateResourceFailedException();

        }
    }
}
