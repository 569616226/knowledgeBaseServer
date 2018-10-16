<?php

namespace App\Containers\Home\UI\API\Controllers;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Home\UI\API\Requests\GetMobileIndexDataRequest;
use App\Containers\Home\UI\API\Requests\SearchMobileIndexDataRequest;
use App\Containers\Home\UI\API\Transformers\AdvertTransformer;
use App\Containers\Home\UI\API\Transformers\AnswerTransformer;
use App\Containers\Home\UI\API\Transformers\LinkaTransformer;
use App\Containers\Home\UI\API\Transformers\NavTransformer;
use App\Containers\Home\UI\API\Transformers\TopicTransformer;
use App\Ship\Parents\Controllers\ApiController;

/**
 * Class Controller
 *
 * @package App\Containers\Home\UI\API\Controllers
 */
class Controller extends ApiController
{
    /*
     * 手机首页数据
     *
     * */
    public function getHomepageContent(GetMobileIndexDataRequest $request)
    {

        $index_data = Apiato::call('Home@GetMobileIndexDataAction');
        $data = [
            'data' => [
                'adverts' => $this->transform($index_data['adverts'],AdvertTransformer::class),
                'linkas'  => $this->transform($index_data['linkas'],LinkaTransformer::class),
                'topics'  => $this->transform($index_data['topics'],TopicTransformer::class),
                'answers' => $this->transform($index_data['answers'],AnswerTransformer::class),
                'navs' => $this->transform($index_data['navs'],NavTransformer::class),
            ]
        ];

        return $data;
    }

    /*
     * 搜索手机首页
     *
     *
     * */
    public function searchHomepageContent(SearchMobileIndexDataRequest $request)
    {

        $answer_data = Apiato::call('Home@SearchMobileAnswerDataAction',[$request]);


        return $this->transform($answer_data,AnswerTransformer::class);
    }

    /*
     * 搜索手机首页
     *
     * @return Topic
     * */
    public function searchHomeTopicContent(SearchMobileIndexDataRequest $request)
    {

        $topic_data = Apiato::call('Home@SearchMobileTopicDataAction',[$request]);


        return $this->transform($topic_data,TopicTransformer::class);
    }
}
