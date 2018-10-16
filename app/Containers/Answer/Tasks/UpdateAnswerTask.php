<?php

namespace App\Containers\Answer\Tasks;

use App\Containers\Answer\Data\Repositories\AnswerRepository;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Illuminate\Support\Facades\Cache;

class UpdateAnswerTask extends Task
{

    private $repository;

    public function __construct(AnswerRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id, array $data)
    {
        try {

            Cache::forget('topic_article_answers');

            $answer = $this->repository->update($data, $id);

            if( array_key_exists('star',$data) && $data['star'] ){ //评价问题

                return $answer->star;

            }else{//回答问题后变更问题状态

                return $answer->status == 1;

            }

        } catch (Exception $exception) {

            report($exception);
            throw new UpdateResourceFailedException();

        }
    }
}
