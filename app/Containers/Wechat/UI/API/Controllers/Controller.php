<?php

namespace App\Containers\Wechat\UI\API\Controllers;

use \Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Wechat\UI\API\Requests\SendEmailRequest;
use App\Ship\Parents\Controllers\ApiController;

/**
 * Class Controller
 *
 * @package App\Containers\Topic\UI\API\Controllers
 */
class Controller extends ApiController
{
    /**
     * @param SendEmailRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendEmail(SendEmailRequest $request)
    {
        return Apiato::call('Wechat@SendEmailAction', [$request]);

    }


}
