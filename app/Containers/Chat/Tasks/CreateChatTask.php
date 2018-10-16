<?php

namespace App\Containers\Chat\Tasks;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Chat\Data\Repositories\ChatRepository;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class CreateChatTask extends Task
{

    private $repository;

    public function __construct(ChatRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($guest_id, array $data,$appoint_id=null)
    {
        try {

            \DB::beginTransaction();

            $old_chat = Apiato::call('Chat@FindChatByIdTask', [$guest_id])->last();

            if ($old_chat) {/*如果是新建預約的時候，发送私信到用户*/

                $data['pid'] = $old_chat->id;

                //更新舊的私信為不爲最新
                $old_chat->guests()->updateExistingPivot(auth_user()->id, ['is_last' => 0]);
                $old_chat->guests()->updateExistingPivot($guest_id, ['is_last' => 0]);

            } else {

                $data['pid'] = 0;

            }

            $chat = $this->repository->create($data);

            if ($chat ) { //发送私信

                $chat->guests()->attach([
                    auth_user()->id => ['is_sender' => 1, 'is_last' => 1, 'reciver_or_sender_id' => $guest_id],
                    $guest_id       => ['is_sender' => 0, 'is_last' => 1, 'reciver_or_sender_id' => auth_user()->id]
                ]);

                \DB::commit();

                return true;

            } else {

                \DB::rollback();

                return false;

            }

        } catch (Exception $exception) {

            \DB::rollback();

            report($exception);
            throw new CreateResourceFailedException();
        }
    }
}
