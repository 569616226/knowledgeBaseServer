<?php

namespace App\Containers\Answer\UI\API\Controllers;


use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Answer\UI\API\Requests\DeleteAnswerRequest;
use App\Containers\Answer\UI\API\Requests\FindAnswerByIdRequest;
use App\Containers\Answer\UI\API\Requests\GetAllAnswerRequest;
use App\Containers\Answer\UI\API\Requests\Mobile\ChangeAnswerStatusRequest;
use App\Containers\Answer\UI\API\Requests\Mobile\CreateAnswerRequest;
use App\Containers\Answer\UI\API\Requests\Mobile\FindGuestAnswerByIdRequest;
use App\Containers\Answer\UI\API\Requests\Mobile\GetAllGuestAnswerRequest;
use App\Containers\Answer\UI\API\Requests\Mobile\GetGuestReadAnswerRequest;
use App\Containers\Answer\UI\API\Requests\Mobile\GetLinkaAnswersRequest;
use App\Containers\Answer\UI\API\Requests\Mobile\GetLinkaHasQuestionAnswersRequest;
use App\Containers\Answer\UI\API\Requests\Mobile\UpdateAnswerRequest;
use App\Containers\Answer\UI\API\Transformers\AnswerTransformer;
use App\Containers\Answer\UI\API\Transformers\GuestAnswerTransformer;
use App\Ship\Parents\Controllers\ApiController;

/**
 * Class Controller
 *
 * @package App\Containers\Answer\UI\API\Controllers
 */
class Controller extends ApiController
{
    /**
     * @param CreateAnswerRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createAnswer(CreateAnswerRequest $request)
    {
        $wechat_jsdk_config = Apiato::call('Answer@CreateAnswerAction', [$request]);

        return $this->json($wechat_jsdk_config);
    }

    /**
     * @param FindAnswerByIdRequest $request
     * @return array
     */
    public function findAnswerById(FindAnswerByIdRequest $request)
    {
        $answer = Apiato::call('Answer@FindAnswerByIdAction', [$request]);

        return $this->transform($answer, AnswerTransformer::class, ['question']);
    }

    /**
     * @param FindAnswerByIdRequest $request
     * @return array | \Illuminate\Http\JsonResponse
     */
    public function findGuestAnswerById(FindGuestAnswerByIdRequest $request)
    {

        $answer = Apiato::call('Answer@FindGuestAnswerByIdAction', [$request]);

        return $this->transform($answer, GuestAnswerTransformer::class);
    }

    /**
     *
     * @param GetAllAnswerRequest $request
     * @return array
     */
    public function getAllAnswers(GetAllAnswerRequest $request)
    {
        $answers = Apiato::call('Answer@GetAllAnswersAction');

        return $this->transform($answers, AnswerTransformer::class);
    }

    /**
     * @param GetAllGuestAnswerRequest $request
     * @return array
     */
    public function getAllGuestAnswer(GetAllGuestAnswerRequest $request)
    {
        $answers = Apiato::call('Answer@GetAllGuestAnswersAction');

        return $this->transform($answers, GuestAnswerTransformer::class);
    }

    /**
     * @param GetLinkaAnswersRequest $request
     * @return array
     */
    public function getLinkaAnswers(GetLinkaAnswersRequest $request)
    {
        $answers = Apiato::call('Answer@GetLinkaAnswersAction');

        return $this->transform($answers, GuestAnswerTransformer::class);
    }

    /**
     * @param GetLinkaAnswersRequest $request
     * @return array
     */
    public function getLinkaHasQuestionAnswers(GetLinkaHasQuestionAnswersRequest $request)
    {
        $answers = Apiato::call('Answer@GetLinkaHasQuestionAnswersAction');

        return $this->transform($answers, GuestAnswerTransformer::class);
    }

    /**
     * @param GetGuestReadAnswerRequest $request
     * @return array
     */
    public function getGuestReadAnswer(GetGuestReadAnswerRequest $request)
    {
        $answers = Apiato::call('Answer@GetGuestReadAnswersAction');

        return $this->transform($answers, GuestAnswerTransformer::class);
    }

    /**
     * @param UpdateAnswerRequest $request
     * @return array
     */
    public function updateAnswer(UpdateAnswerRequest $request)
    {
        $result  = Apiato::call('Answer@UpdateAnswerAction', [$request]);

        return simple_respone($result);
    }

    /**
     * @param DeleteAnswerRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteAnswer(DeleteAnswerRequest $request)
    {
        Apiato::call('Answer@DeleteAnswerAction', [$request]);

        return $this->noContent();
    }
}
