<?php

namespace App\Containers\Message\UI\API\Controllers;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Message\UI\API\Requests\CreateMessageRequest;
use App\Containers\Message\UI\API\Requests\FindMessageByIdRequest;
use App\Containers\Message\UI\API\Requests\GetAllMessagesRequest;
use App\Containers\Message\UI\API\Requests\GetAllSystemMessagesRequest;
use App\Containers\Message\UI\API\Transformers\MessageTransformer;
use App\Ship\Parents\Controllers\ApiController;

/**
 * Class Controller
 *
 * @package App\Containers\Message\UI\API\Controllers
 */
class Controller extends ApiController
{
    /**
     * @param CreateMessageRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createMessage(CreateMessageRequest $request)
    {
        $message = Apiato::call('Message@CreateMessageAction', [$request]);
        return $this->created($this->transform($message, MessageTransformer::class), 200);
    }

    /**
     * @param FindMessageByIdRequest $request
     * @return array
     */
    public function findMessageById(FindMessageByIdRequest $request)
    {
        $message = Apiato::call('Message@FindMessageByIdAction', [$request]);
        return $this->transform($message, MessageTransformer::class);
    }

    /**
     * @param GetAllSystemMessagesRequest $request
     * @return array
     */
    public function getAllSystemMessages(GetAllSystemMessagesRequest $request)
    {
        $messages = Apiato::call('Message@GetAllSystemMessagesAction');
        return $this->transform($messages, MessageTransformer::class);
    }

    /**
     * @param GetAllMessagesRequest
     * @return array
     */
    public function getAllMessages(GetAllMessagesRequest $request)
    {
        $messages = Apiato::call('Message@GetAllMessagesAction');
        return $this->transform($messages, MessageTransformer::class);
    }



}
