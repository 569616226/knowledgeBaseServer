<?php

namespace App\Containers\Message\Tasks;

use App\Containers\Message\Data\Repositories\MessageRepository;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class CreateMessageTask extends Task
{

    private $repository;

    public function __construct(MessageRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(array $message_data )
    {
        try {

            $guests = $message_data['group']->guests;
            $guest_ids = $guests->pluck('id')->toArray();

            send_wechat_msg($guests,$message_data['data'],$message_data['data']['img_url'],$message_data['url']);

            $message = $this->repository->create($message_data['data']);

            $message->guests()->attach($guest_ids);

            return $message;

        } catch (Exception $exception) {
            report($exception);
            throw new CreateResourceFailedException();
        }
    }
}
