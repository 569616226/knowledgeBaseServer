<?php

namespace App\Containers\Nav\Tasks;

use App\Containers\Answer\Models\Answer;
use App\Containers\Nav\Models\Nav;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class GetNavAnswersTask extends Task
{

    public function run($id, array $data)
    {
        try {

            $order_by = $data['order_by'];
            $limit = $data['limit'];
            $page = $data['page'];

            $nav = Nav::findOrFail($id);

            /*获取领域下的问题*/
            $guests = $nav->guests;
            $answerIds = [];
            foreach ($guests as $guest) {

                if($guest->questions){

                    $answer_ids = $guest->questions->pluck('answer_id')->toArray();
                    $answerIds = array_merge($answerIds, $answer_ids);
                }

            }

            /*过滤问题*/
            $answers = Answer::whereIn('id',$answerIds)->when($order_by == 2,function($query){//评分最高

                return  $query->orderBy('star','desc');

            },function($query){//默认

                return  $query->orderBy('created_at','desc');

            })->paginate();

            /*人氣最高 */
            if ($order_by == 1) {

                $answers = collect($answers->sortByDesc(function ($product, $key) use ($order_by) {

                    if($product->readers){

                        return $product->readers->count();

                    }else{

                        return 0;

                    }

                })->forPage($page, $limit)->all());
            }

            return $answers;

        } catch (Exception $exception) {

            report($exception);
            throw new UpdateResourceFailedException();
        }
    }
}
