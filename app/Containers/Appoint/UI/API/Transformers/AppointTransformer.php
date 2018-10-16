<?php

namespace App\Containers\Appoint\UI\API\Transformers;

use App\Containers\Appoint\Models\Appoint;
use App\Containers\Topic\UI\API\Transformers\TopicTransformer;
use App\Ship\Parents\Transformers\Transformer;

class AppointTransformer extends Transformer
{
    /**
     * @var  array
     */
    protected $defaultIncludes = [
        'topic',
    ];

    /**
     * @var  array
     */
    protected $availableIncludes = [
        'topic',
    ];

    /**
     * @param Appoint $entity
     *
     * @return array
     */
    public function transform(Appoint $entity)
    {
        $status = [
            0 => '已取消',
            1 => '待付款',
            3 => '待见面',
            4 => '待评价',
            5 => '已完成',
            6 => '已拒绝',
        ];

        $ser_type = [
            0 => '线下约见',
            1 => '全国通话',
        ];

        /*订单自动关闭时间*/
        $system_order_settings =get_appoint_order_cancel_time();//获取系统设置订单自动关闭时间

        $hour = $entity->created_at->addHours($system_order_settings)->diffInHours(now());
        $minutes = $entity->created_at->addHours($system_order_settings)->diffInMinutes(now()) - $hour * 60;

        $cancel_time = $hour . '小时' . $minutes . '分钟';

        $response = [
            'object'             => 'Appoint',
            'id'                 => $entity->getHashedKey(),
            'real_id'            => $entity->id,
            'topic_name'         => $entity->topic->title,
            'ser_type'           => $ser_type[$entity->topic->ser_type],
            'status'             => $status[$entity->status] ?? '待确认',
            'status_times'       => $entity->status_times,
            'cancel_res'         => $entity->cancel_res,
            'cancel_time'        => $cancel_time,
            'canceler'           => $entity->canceler,
            'answers'            => $entity->answers,
            'profile'            => $entity->profile,
            'case_id'            => $entity->case_id,
            'linka_id'           => $entity->topic->guest->id,
            'guest_id'           => $entity->guest->id,
            'is_appoint_creator' => auth_user() && auth_user()->id == $entity->guest->id ? true : false,
            'guest_name'         => $entity->guest->name,
            'guest_phone'        => $entity->guest->phone,
            'created_at'         => $entity->created_at->toDateTimeString(),
            'updated_at'         => $entity->updated_at->toDateTimeString(),
        ];

        /*约见评价*/
        if ($entity->appoint_appraise) {

            $response = array_merge($response, [

                'appoint_appraise' => $entity->appoint_appraise

            ]);

        }

        if ($entity->appoint_cases) {

            $appointCases = [];

            foreach ($entity->appoint_cases as $appoint_case) {

                $appoint_case_date = [

                    'appoint_time' => $appoint_case->appoint_time->format('Y-m-d H:i'),
                    'id'           => $appoint_case->id,
                    'location'     => $appoint_case->location,
                    'appoint_id'   => $appoint_case->appoint_id,
                ];

                array_push($appointCases, $appoint_case_date);
            }

            $response = array_merge($response, [

                'appoint_cases' => $appointCases

            ]);
        }

        return $response;
    }

    public function includeTopic(Appoint $entity)
    {
        return $this->item($entity->topic, new TopicTransformer());
    }
}
