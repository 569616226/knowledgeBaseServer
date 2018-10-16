<?php

namespace App\Containers\Finace\UI\API\Transformers;

use App\Containers\Finace\Models\Finace;
use App\Ship\Parents\Transformers\Transformer;

class MobileFinaceTransformer extends Transformer
{


    /**
     * @param Finace $entity
     *
     * @return array
     */
    public function transform(Finace $entity)
    {
        $finace_type = [
            0 => '回答问题收入',
            1 => '约见学员收入',
            2 => '约见大咖收入',
            3 => '问答被查看收入',
            4 => '收到违约金',
            5 => '提现金额',
        ];


        $response = [
            'object'      => 'Finace',
            'id'          => $entity->getHashedKey(),
            'name'        => $entity->name,
            'order_name'  => $entity->order_name,
            'order_no'    => $entity->order_no,
            'price'       => $entity->price,
            'finace_type' => $finace_type[$entity->type],
            'guest_name'  => $entity->guest->name,
            'created_at'  => $entity->created_at->toDateTimeString(),
            'updated_at'  => $entity->updated_at->toDateTimeString(),
        ];

        return $response;
    }
}
