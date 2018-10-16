<?php

namespace App\Containers\Answer\Tasks;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Answer\Data\Repositories\AnswerRepository;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Illuminate\Support\Facades\Cache;

class CreateAnswerTask extends Task
{

    private $repository;

    public function __construct(AnswerRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(array $data)
    {

        try {

            \DB::beginTransaction();

            $answer = $this->repository->create($data['answer_data']);

            if($answer){

                auth_user()->answers()->attach([$answer->id => ['is_creator' => 1]]);

                $question_data = [
                    'guest_id'  => $data['linka_id'],
                    'answer_id' => $answer->id,
                ];

                Apiato::call('Question@CreateQuestionTask', [$question_data]);

                $wechat_jsdk_config = create_orders($answer, 0);

                if ($wechat_jsdk_config) {

                    \DB::commit();

                    Cache::forget('topic_article_answers');

                    $wechat_jsdk_config['answer_id'] = $answer->getHashedKey();//返回問答ID

                    return  $wechat_jsdk_config;

                } else {

                    \DB::rollBack();

                }

            }

            return simple_respone(false);

        } catch (Exception $exception) {

            \DB::rollBack();
            report($exception);
            throw new CreateResourceFailedException();
        }
    }
}
