<?php

namespace App\Containers\Order\UI\WEB\Controllers;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Controllers\WebController;

/**
 * Class Controller
 *
 * @package App\Containers\Order\UI\API\Controllers
 */
class Controller extends WebController
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function wechatNotifyUrl()
    {


        $reslut = Apiato::call('Order@WechatNotifyUrlAction');

        return $reslut;
    }

}
