<?php

namespace App\Containers\Order\Tasks;

use App\Containers\Answer\Models\Answer;
use App\Containers\Order\Data\Repositories\OrderRepository;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class CreateSeeAnswerOrderTask extends Task
{

    private $repository;

    public function __construct(OrderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(Answer $answer)
    {

        try {

            $wechat_jsdk_config = create_orders($answer,1);//查看问题

            $wechat_jsdk_config['answer_id'] = $answer->getHashedKey();

            return $wechat_jsdk_config;

        } catch (Exception $exception) {

            report($exception);
            throw new CreateResourceFailedException();

        }
    }
}
