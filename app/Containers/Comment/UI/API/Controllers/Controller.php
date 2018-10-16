<?php

namespace App\Containers\Comment\UI\API\Controllers;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Comment\UI\API\Requests\CreateCommentRequest;
use App\Containers\Comment\UI\API\Requests\DeleteCommentRequest;
use App\Ship\Parents\Controllers\ApiController;

/**
 * Class Controller
 *
 * @package App\Containers\Comment\UI\API\Controllers
 */
class Controller extends ApiController
{
    /**
     * @param CreateCommentRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createComment(CreateCommentRequest $request)
    {
        $comment = Apiato::call('Comment@CreateCommentAction', [$request]);

        return simple_respone($comment);
    }

    /**
     * @param DeleteCommentRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteComment(DeleteCommentRequest $request)
    {
        $comment = Apiato::call('Comment@DeleteCommentAction', [$request]);

        return simple_respone($comment);
    }


}
