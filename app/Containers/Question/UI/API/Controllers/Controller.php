<?php

namespace App\Containers\Question\UI\API\Controllers;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Question\UI\API\Requests\CreateQuestionRequest;
use App\Containers\Question\UI\API\Requests\DeleteQuestionRequest;
use App\Containers\Question\UI\API\Requests\FindQuestionByIdRequest;
use App\Containers\Question\UI\API\Requests\UpdateQuestionRequest;
use App\Containers\Question\UI\API\Transformers\GuestQuestionTransformer;
use App\Containers\Question\UI\API\Transformers\QuestionTransformer;
use App\Ship\Parents\Controllers\ApiController;

/**
 * Class Controller
 *
 * @package App\Containers\Question\UI\API\Controllers
 */
class Controller extends ApiController
{


    /**
     * @param UpdateQuestionRequest $request
     * @return array
     */
    public function updateQuestion(UpdateQuestionRequest $request)
    {
        $result = Apiato::call('Question@UpdateQuestionAction', [$request]);

        return simple_respone($result);
    }


}
