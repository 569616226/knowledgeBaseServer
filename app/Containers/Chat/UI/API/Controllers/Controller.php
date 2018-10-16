<?php

namespace App\Containers\Chat\UI\API\Controllers;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Chat\UI\API\Requests\CreateChatRequest;
use App\Containers\Chat\UI\API\Requests\DeleteChatRequest;
use App\Containers\Chat\UI\API\Requests\FindChatByIdRequest;
use App\Containers\Chat\UI\API\Requests\GetAllChatsRequest;
use App\Containers\Chat\UI\API\Requests\UpdateChatRequest;
use App\Containers\Chat\UI\API\Transformers\ChatTransformer;
use App\Containers\Chat\UI\API\Transformers\NewChatsTransformer;
use App\Ship\Parents\Controllers\ApiController;

/**
 * Class Controller
 *
 * @package App\Containers\Chat\UI\API\Controllers
 */
class Controller extends ApiController
{
    /**
     * @param CreateChatRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createChat(CreateChatRequest $request)
    {
         $reslut = Apiato::call('Chat@CreateChatAction', [$request]);

        return simple_respone($reslut);
    }

    /**
     * @param FindChatByIdRequest $request
     * @return array
     */
    public function findChatById(FindChatByIdRequest $request)
    {
        $chats = Apiato::call('Chat@FindChatByIdAction', [$request]);

        return $this->transform($chats, ChatTransformer::class);
    }

    /**
     * @param GetAllChatsRequest $request
     * @return array
     */
    public function getAllChats(GetAllChatsRequest $request)
    {
        $chats = Apiato::call('Chat@GetAllChatsAction', [$request]);

        return $this->transform($chats, NewChatsTransformer::class);
    }

}
