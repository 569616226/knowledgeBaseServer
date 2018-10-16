<?php

namespace App\Containers\Order\UI\API\Controllers;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Order\UI\API\Requests\CreateCaseOrderRequest;
use App\Containers\Order\UI\API\Requests\CreateSeeAnswerOrderRequest;
use App\Containers\Order\UI\API\Requests\PayNotPayOrderRequest;
use App\Ship\Parents\Controllers\ApiController;

/**
 * Class Controller
 *
 * @package App\Containers\Order\UI\API\Controllers
 */
class MobileController extends ApiController
{

    /**
     * @param CreateCaseOrderRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createCaseOrder(CreateCaseOrderRequest $request)
    {

        return Apiato::call('Order@CreateCaseOrderAction', [$request]);
    }

    /**
     * @param CreateSeeAnswerOrderRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createSeeAnswerOrder(CreateSeeAnswerOrderRequest $request)
    {
        $wechat_jsdk_config = Apiato::call('Order@CreateSeeAnswerOrderAction', [$request]);

        return $this->json($wechat_jsdk_config);
    }

    /**
     * @return array
     */
    public function payNotPayOrder(PayNotPayOrderRequest $request)
    {
        return Apiato::call('Order@PayNotPayOrderAction',[$request]);

    }

}
