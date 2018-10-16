<?php

namespace App\Containers\Nav\Tasks;

use App\Containers\Nav\Models\Nav;
use App\Containers\Topic\Models\Topic;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class GetNavTopicsTask extends Task
{

    public function run($id, array $data)
    {
        try {

            $topic_type = $data['topic_type'];
            $order_by = $data['order_by'];
            $limit = $data['limit'];
            $page = $data['page'];

            $nav = Nav::find($id);

            $topic_ids = [];
            foreach ($nav->guests as $guest) {
                $topicIds = $guest->topics()->whereStatus(1)->get()->pluck('id')->toArray();
                $topic_ids = array_merge($topic_ids, $topicIds);
            }

            $topics = Topic::whereIn('id', $topic_ids)->when($topic_type !== null, function ($query) use ($topic_type) {
                return $query->where('ser_type', $topic_type);
            })->get();

            /*不同方式排序排序 */
            if($order_by == 3){

                $topics = $topics->sortBy(function ($product, $key) use ($order_by) {

                    return $product->price;

                })->forPage($page, $limit)->all();

            }else{

                $topics = $topics->sortByDesc(function ($product, $key) use ($order_by) {

                    switch ($order_by) {

                        case 1://人气最高

                            return $product->appoints()->whereStatus(5)->get()->count();//完成约见数量

                            break;

                        case 2://最新预约

                            $appoint = $product->appoints()->orderBy('created_at', 'desc')->first();

                            if($appoint){

                                return $appoint->created_at->timestamp;

                            }else{

                                return 0;
                            }

                            break;

                        default:

                            return $product->created_at->timestamp;

                            break;
                    }

                })->forPage($page, $limit)->all();

            }

            return collect($topics);

        } catch (Exception $exception) {

            report($exception);
            throw new UpdateResourceFailedException();
        }
    }
}
