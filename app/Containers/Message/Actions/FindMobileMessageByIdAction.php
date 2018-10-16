<?php

namespace App\Containers\Message\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class FindMobileMessageByIdAction extends Action
{
    public function run(Request $request)
    {
        $message = Apiato::call('Message@FindMessageByIdTask', [$request->id]);

        if( in_array(auth_user()->id,$message->guests->pluck('id')->toArray()) ){
            $message->is_read = 1;
            $message->save();
        }

        return $message;
    }
}
