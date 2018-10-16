<?php

namespace App\Containers\Guest\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class FindGuestByIdAction extends Action
{
    public function run(Request $request)
    {
        $guest = Apiato::call('Guest@FindGuestByIdTask', [$request->id]);

        /*
         * 生成瀏覽過的大咖數據 只在手机端生效
         *
         * */
        if($guest && $guest->status == 1 && auth_user()){

            $viewed_linkas = auth_user()->viewed_linkas ?? [];

            /*如果沒有瀏覽過大咖，就把大咖加入到瀏覽記錄中*/
            if( !in_array($guest->id,$viewed_linkas) ){

                array_push($viewed_linkas,$guest->id);

                auth_user()->viewed_linkas = $viewed_linkas;
                auth_user()->save();

            }
        }

        return $guest;
    }
}
