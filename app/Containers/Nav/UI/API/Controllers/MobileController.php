<?php

namespace App\Containers\Nav\UI\API\Controllers;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Nav\UI\API\Requests\Mobile\GetAllNavsRequest;
use App\Containers\Nav\UI\API\Requests\Mobile\GetChildrenNavsRequest;
use App\Containers\Nav\UI\API\Requests\Mobile\GetNavAnswersByIdRequest;
use App\Containers\Nav\UI\API\Requests\Mobile\GetNavLinkasByIdRequest;
use App\Containers\Nav\UI\API\Requests\Mobile\GetNavTopicsByIdRequest;
use App\Containers\Nav\UI\API\Transformers\Mobile\ChildrenNavTransformer as MobileChildrenNavTransformer;
use App\Containers\Nav\UI\API\Transformers\Mobile\NavAnswerTransformer;
use App\Containers\Nav\UI\API\Transformers\Mobile\NavLinkaTransformer;
use App\Containers\Nav\UI\API\Transformers\Mobile\NavTopicsTransformer;
use App\Containers\Nav\UI\API\Transformers\Mobile\NavTransformer as MobileNavTransformer;
use App\Ship\Parents\Controllers\ApiController;

/**
 * Class Controller
 *
 * @package App\Containers\Nav\UI\API\Controllers
 */
class MobileController extends ApiController
{

    /**
     * 手机所有领域（包括子领域）
     *
     * @param GetAllNavsRequest $request
     * @return array
     */
    public function getMobileNavs(GetAllNavsRequest $request)
    {
        $navs = Apiato::call('Nav@GetMobileAllNavsAction');

        return $this->transform($navs, MobileNavTransformer::class);
    }


    /**
     * 手机所有子领域
     *
     * @param GetAllNavsRequest $request
     * @return array
     */
    public function getMobileChildrenNavs(GetChildrenNavsRequest $request)
    {
        $navs = Apiato::call('Nav@GetMobileChildrenNavsAction');

        return $this->transform($navs, MobileChildrenNavTransformer::class);
    }

    /**
     * 分类下的问题（包括大咖信息和话题信息 可排序和根据服务类型筛选）
     *
     * @param GetNavLinkasByIdRequest $request
     * @return array
     */
    public function getNavLinkasById(GetNavLinkasByIdRequest $request)
    {
        $linkas = Apiato::call('Nav@GetNavLinkasAction',[$request]);

        return $this->transform($linkas, NavLinkaTransformer::class);
    }

    /**
     * 分类下的问题（包括大咖信息和话题信息 可排序和根据服务类型筛选）
     *
     * @param GetNavLinkasByIdRequest $request
     * @return array
     */
    public function findNavTopicsById(GetNavTopicsByIdRequest $request)
    {
        $linkas = Apiato::call('Nav@GetNavTopicsAction',[$request]);

        return $this->transform($linkas, NavTopicsTransformer::class);
    }

    /**
     * 分类下的问题（包括大咖信息和问题信息 可排序）
     *
     * @param GetNavAnswersByIdRequest $request
     * @return array
     */
    public function findNavAnswersById(GetNavAnswersByIdRequest $request)
    {
        $answers = Apiato::call('Nav@GetNavAnswersAction',[$request]);

        return $this->transform($answers, NavAnswerTransformer::class);
    }


}
