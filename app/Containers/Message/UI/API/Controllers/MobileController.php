<?php

namespace App\Containers\Message\UI\API\Controllers;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Message\UI\API\Requests\Mobile\FindMessageByIdRequest as MobileFindMessageByIdRequest;
use App\Containers\Message\UI\API\Requests\Mobile\GetGuestGroupMessagesRequest;
use App\Containers\Message\UI\API\Requests\Mobile\GetGuestSystemMessagesRequest;
use App\Containers\Message\UI\API\Transformers\MessageTransformer;
use App\Ship\Parents\Controllers\ApiController;

/**
 * Class Controller
 *
 * @package App\Containers\Message\UI\API\Controllers
 */
class MobileController extends ApiController
{

    /**
     * @param MobileFindMessageByIdRequest $request
     * @return array
     */
    public function findMobileMessageById(MobileFindMessageByIdRequest $request)
    {
        $message = Apiato::call('Message@FindMobileMessageByIdAction', [$request]);

        return $this->transform($message, MessageTransformer::class);
    }
    /**
     * @param GetGuestSystemMessagesRequest
     * @return array
     */
    public function getGuestSystemMessages(GetGuestSystemMessagesRequest $request)
    {
        $messages = Apiato::call('Message@GetGuestSystemMessagesAction');
        return $this->transform($messages, MessageTransformer::class);
    }

    /**
     * @param GetGuestGroupMessagesRequest
     * @return array
     */
    public function getGuestGroupMessages(GetGuestGroupMessagesRequest $request)
    {
        $messages = Apiato::call('Message@GetGuestGroupMessagesAction');
        return $this->transform($messages, MessageTransformer::class);
    }


}
