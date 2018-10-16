<?php

namespace App\Containers\Answer\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class CreateAnswerAction extends Action
{
    public function run(Request $request)
    {
        $price = get_create_answer_price();//提问价格

        $data = [

            'answer_data' => [
                'name'  => $request->get('name'),
                'price' => $price,
                'status' => 3,
            ],

            'linka_id' =>  $request->get('linka_id')
        ];

      return Apiato::call('Answer@CreateAnswerTask', [$data]);

    }
}
