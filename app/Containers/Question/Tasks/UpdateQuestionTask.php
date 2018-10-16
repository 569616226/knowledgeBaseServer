<?php

namespace App\Containers\Question\Tasks;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Question\Data\Repositories\QuestionRepository;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Exceptions\Exception;
use App\Ship\Parents\Tasks\Task;

class UpdateQuestionTask extends Task
{

    private $repository;

    public function __construct(QuestionRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id, array $data)
    {
        try {

            \DB::beginTransaction();

            $question = $this->repository->update($data, $id);

            /*改变问答的状态为已回答*/
            $update_answer_staus = Apiato::call('Answer@UpdateAnswerTask', [$question->answer->id, ['status' => 1]]);

            if ($update_answer_staus) {

                $temp_id = config('appoint-container.wechat_appoint_temp_id');
                $url = env('APP_MOBILE_URL') . '/#/questiondetail/' . $question->answer->getHashedKey();
                $guest = $question->answer->creator->first();

                send_wechat_temp_msg($guest, $temp_id, $url, '大咖已回答您的提问，快去查看打分吧！', '问题', $question->answer->name, '大咖已回答您的提问，快去查看打分吧！');//微信审核消息

                \DB::commit();

                return true;

            } else {

                \DB::rollback();
                return false;
            }

        } catch (Exception $exception) {

            \DB::rollback();
            report($exception);
            throw new UpdateResourceFailedException();
        }
    }
}
