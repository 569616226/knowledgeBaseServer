<?php

namespace App\Containers\Topic\UI\API\Controllers;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Answer\Models\Answer;
use App\Containers\Answer\UI\API\Transformers\AnswerTransformer;
use App\Containers\Appoint\UI\API\Requests\ChangeAppointStatusRequest;
use App\Containers\Article\Models\Article;
use App\Containers\Article\UI\API\Transformers\ArticleTransformer;
use App\Containers\Topic\Models\Topic;
use App\Containers\Topic\UI\API\Requests\ChangeTopicStatusRequest;
use App\Containers\Topic\UI\API\Requests\CreateTopicRequest;
use App\Containers\Topic\UI\API\Requests\DeleteTopicRequest;
use App\Containers\Topic\UI\API\Requests\FindGuestTopicByIdRequest;
use App\Containers\Topic\UI\API\Requests\FindTopicByIdRequest;
use App\Containers\Topic\UI\API\Requests\GetAllTopicsRequest;
use App\Containers\Topic\UI\API\Requests\SendEmailRequest;
use App\Containers\Topic\UI\API\Requests\UpdateTopicRequest;
use App\Containers\Topic\UI\API\Transformers\Mobile\MobileTopicTransformer;
use App\Containers\Topic\UI\API\Transformers\TopicTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Support\Facades\Cache;

/**
 * Class Controller
 *
 * @package App\Containers\Topic\UI\API\Controllers
 */
class Controller extends ApiController
{
    /**
     * @param CreateTopicRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createTopic(CreateTopicRequest $request)
    {
        $topic = Apiato::call('Topic@CreateTopicAction', [$request]);

        return $this->created($this->transform($topic, TopicTransformer::class), 200);
    }

    /**
     * @param FindTopicByIdRequest $request
     * @return array
     */
    public function findTopicById(FindTopicByIdRequest $request)
    {
        $topic = Apiato::call('Topic@FindTopicByIdAction', [$request]);

        return $this->transform($topic, TopicTransformer::class);
    }

    /**
     * @param ChangeTopicStatusRequest $request
     * @return array
     */
    public function changeTopicStatus(ChangeTopicStatusRequest $request)
    {
        $topic = Apiato::call('Topic@ChangeTopicStatusAction', [$request]);

        return $this->transform($topic, TopicTransformer::class);
    }

    /**
     * @param FindTopicByIdRequest $request
     * @return array
     */
    public function findGuestTopicById(FindGuestTopicByIdRequest $request)
    {
        $topic = Apiato::call('Topic@FindTopicByIdAction', [$request]);

        return $this->transform($topic, MobileTopicTransformer::class);
    }

    /**
     * @param GetAllTopicsRequest $request
     * @return array
     */
    public function getAllTopics(GetAllTopicsRequest $request)
    {
        $topics = Apiato::call('Topic@GetAllTopicsAction');

        return $this->transform($topics, TopicTransformer::class);
    }

    /**
     * @return array
     */
    public function GetAllGuestTopic()
    {
        $topics = Apiato::call('Topic@GetAllGuestTopicsAction');

        return $this->transform($topics, TopicTransformer::class);
    }

    /**
     * @param UpdateTopicRequest $request
     * @return array
     */
    public function updateTopic(UpdateTopicRequest $request)
    {

        $topic = Apiato::call('Topic@UpdateTopicAction', [$request]);

        return $this->transform($topic, TopicTransformer::class);
    }

    /**
     * @param DeleteTopicRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteTopic(DeleteTopicRequest $request)
    {
        Apiato::call('Topic@DeleteTopicAction', [$request]);

        return $this->accepted([
            'status' => true,
            'msg'    => "操作成功",
        ], 202);

    }

    /**
     *约问页面
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function findTopicArticleAnswers()
    {

        $page_index = request('page_index') ?? 1;//当前页码 默认1
        $page_count = request('page_count') ?? 10;//每页数量默认10

        $topic_article_answers = Cache::get('topic_article_answers');
        if ($topic_article_answers) {

            return $this->json(count($topic_article_answers) ? array('data' => $topic_article_answers[$page_index-1]->values()) : []);

        }else{

            /*有话题确认约见的话题显示在约问页面*/
            $topics = Topic::whereHas('appoints',function($appoint){
                $appoint->whereIn('status',[1,3,4,5]);
            } )->whereStatus(1)->get();

            $topics = $this->transform($topics, new TopicTransformer());
            $answers = $this->transform(Answer::whereStatus(1 )->get(), new AnswerTransformer());
            $articles = $this->transform(Article::whereStatus(1)->get(), new ArticleTransformer());

            /*对问题，话题，文章按创建时间综合倒序排列*/
            $merged = [];
            array_push($merged, $topics['data']);
            array_push($merged, $answers['data']);
            array_push($merged, $articles['data']);

            $merged = collect($merged)->collapse()->sortByDesc('created_at')->chunk($page_count);

            Cache::forever('topic_article_answers', $merged);

            return  $this->json( count($merged) ? array('data' => $merged[$page_index-1]->values()): [] ) ;
        }

    }
}
