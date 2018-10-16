<?php

namespace App\Containers\Chat\Tasks;

use App\Containers\Chat\Data\Repositories\ChatRepository;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class FindChatByIdTask extends Task
{

    private $repository;

    public function __construct(ChatRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id)
    {
        try {

            $chats = auth_user()->chats;

            $chats = $chats->filter(function ($value, $key) use ($id) {
                return $value->pivot->reciver_or_sender_id == $id;
            })->sortBy('id')->all();

            return collect($chats);

        } catch (Exception $exception) {

            report($exception);
            throw new NotFoundException();

        }
    }
}
