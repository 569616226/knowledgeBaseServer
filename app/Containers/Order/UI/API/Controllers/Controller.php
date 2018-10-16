<?php

namespace App\Containers\Order\UI\API\Controllers;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Order\UI\API\Requests\ChangeOrderAuditStatusRequest;
use App\Containers\Order\UI\API\Requests\ChangeOrderStatusRequest;
use App\Containers\Order\UI\API\Requests\FindAnswerOrderByIdRequest;
use App\Containers\Order\UI\API\Requests\FindCancelOrderByIdRequest;
use App\Containers\Order\UI\API\Requests\FindCaseOrderByIdRequest;
use App\Containers\Order\UI\API\Requests\FindOrderByIdRequest;
use App\Containers\Order\UI\API\Requests\FindRefundOrderByIdRequest;
use App\Containers\Order\UI\API\Requests\GetAllAnswerOrdersRequest;
use App\Containers\Order\UI\API\Requests\GetAllCancelOrdersRequest;
use App\Containers\Order\UI\API\Requests\GetAllCaseOrdersRequest;
use App\Containers\Order\UI\API\Requests\GetAllOrdersRequest;
use App\Containers\Order\UI\API\Requests\GetAllRefundOrdersRequest;
use App\Containers\Order\UI\API\Transformers\AnswerOrderTransformer;
use App\Containers\Order\UI\API\Transformers\CancelOrderTransformer;
use App\Containers\Order\UI\API\Transformers\CaseOrderTransformer;
use App\Containers\Order\UI\API\Transformers\OrderTransformer;
use App\Containers\Order\UI\API\Transformers\RefundOrderTransformer;
use App\Ship\Parents\Controllers\ApiController;

/**
 * Class Controller
 *
 * @package App\Containers\Order\UI\API\Controllers
 */
class Controller extends ApiController
{



    /**
     * @param FindOrderByIdRequest $request
     * @return array
     */
    public function findOrderById(FindOrderByIdRequest $request)
    {
        $order = Apiato::call('Order@FindOrderByIdAction', [$request]);

        return $this->transform($order, OrderTransformer::class);
    }

    /**
     * @return array
     */
    public function findOrderJsdkConfig()
    {
        $order_jsdk_config = Apiato::call('Order@FindOrderJsdkConfigAction');

        return $order_jsdk_config;
    }

    /**
     * @param FindOrderByIdRequest $request
     * @return array
     */
    public function findRefundOrderById(FindRefundOrderByIdRequest $request)
    {
        $order = Apiato::call('Order@FindOrderByIdAction', [$request]);

        return $this->transform($order, RefundOrderTransformer::class);
    }


    /**
     * @param FindOrderByIdRequest $request
     * @return array
     */
    public function findCaseOrderById(FindCaseOrderByIdRequest $request)
    {
        $order = Apiato::call('Order@FindOrderByIdAction', [$request]);

        return $this->transform($order, CaseOrderTransformer::class);
    }

    /**
     * @param FindOrderByIdRequest $request
     * @return array
     */
    public function findCancelOrderById(FindCancelOrderByIdRequest $request)
    {
        $order = Apiato::call('Order@FindOrderByIdAction', [$request]);

        return $this->transform($order, CancelOrderTransformer::class);
    }

    /**
     * @param FindOrderByIdRequest $request
     * @return array
     */
    public function findAnswerOrderById(FindAnswerOrderByIdRequest $request)
    {
        $order = Apiato::call('Order@FindOrderByIdAction', [$request]);

        return $this->transform($order, AnswerOrderTransformer::class);
    }


    /**
     * @return array
     */
    public function getAllRefundOrders(GetAllRefundOrdersRequest $request)
    {
        $orders = Apiato::call('Order@GetAllRefundOrdersAction');

        return $this->transform($orders, RefundOrderTransformer::class);
    }

    /**
     * @return array
     */
    public function getAllCancelOrders(GetAllCancelOrdersRequest $request)
    {
        $orders = Apiato::call('Order@GetAllCancelOrdersAction');

        return $this->transform($orders, CancelOrderTransformer::class);
    }

    /**
     * @return array
     */
    public function getAllAnswerOrders(GetAllAnswerOrdersRequest $request)
    {
        $orders = Apiato::call('Order@GetAllAnswerOrdersAction');

        return $this->transform($orders, AnswerOrderTransformer::class);
    }

    /**
     * @return array
     */
    public function getAllAppointOrders(GetAllOrdersRequest $request)
    {
        $orders = Apiato::call('Order@GetAllAppointOrdersAction');

        return $this->transform($orders, OrderTransformer::class);
    }

    /**
     * @return array
     */
    public function getAllCaseOrders(GetAllCaseOrdersRequest $request)
    {
        $orders = Apiato::call('Order@GetAllCaseOrdersAction');

        return $this->transform($orders, CaseOrderTransformer::class);
    }

    /**
     * @param ChangeOrderStatusRequest $request
     * @return array
     */
    public function changeStatus(ChangeOrderStatusRequest $request)
    {
        $order = Apiato::call('Order@ChangeOrderStatusAction', [$request]);

        return simple_respone($order);
    }

    /**
     * @param ChangeOrderAuditStatusRequest $request
     * @return array
     */
    public function changeAuditStatus(ChangeOrderAuditStatusRequest $request)
    {
        $reslut = Apiato::call('Order@ChangeOrderAuditStatusAction', [$request]);

        return simple_respone($reslut);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function wechatNotifyUrl()
    {
        $reslut = Apiato::call('Order@WechatNotifyUrlAction');

        return $reslut;
    }
}
