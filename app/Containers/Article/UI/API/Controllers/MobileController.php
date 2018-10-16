<?php

namespace App\Containers\Article\UI\API\Controllers;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Article\UI\API\Requests\Mobile\CreateArticleRequest;
use App\Containers\Article\UI\API\Requests\Mobile\DeleteArticleRequest;
use App\Containers\Article\UI\API\Requests\Mobile\FindArticleByIdRequest;
use App\Containers\Article\UI\API\Requests\Mobile\GetArticlesForMobile;
use App\Containers\Article\UI\API\Requests\Mobile\LikeArticleRequest;
use App\Containers\Article\UI\API\Requests\Mobile\UpdateArticleRequest;
use App\Containers\Article\UI\API\Transformers\Mobile\MobileArticleTransformer;
use App\Ship\Parents\Controllers\ApiController;

/**
 * Class Controller
 *
 * @package App\Containers\Article\UI\API\Controllers
 */
class MobileController extends ApiController
{

    /**
     * @param CreateArticleRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createArticle(CreateArticleRequest $request)
    {
        $article = Apiato::call('Article@CreateArticleAction', [$request]);

        return $this->created($this->transform($article, MobileArticleTransformer::class), 200);
    }

    /**
     * @param UpdateArticleRequest $request
     * @return array
     */
    public function updateArticle(UpdateArticleRequest $request)
    {
        $article = Apiato::call('Article@UpdateArticleAction', [$request]);
        return $this->transform($article, MobileArticleTransformer::class);
    }

    /**
     * @param LikeArticleRequest $request
     * @return array
     */
    public function likeArticle(LikeArticleRequest $request)
    {
        return Apiato::call('Article@LikeArticleAction', [$request]);
    }

    /**
     * @param DeleteArticleRequest $request
     * @return array
     */
    public function deleteArticle(DeleteArticleRequest $request)
    {

        return simple_respone(Apiato::call('Article@DeleteArticleAction', [$request]));
    }


    /**
     * @param GetArticlesForMobile $request
     * @return array
     */
    public function mobileArticles(GetArticlesForMobile $request)
    {
        $articles = Apiato::call('Article@GetGuestArticlesAction');

        return $this->transform($articles, MobileArticleTransformer::class);
    }

    /**
     * @param FindArticleByIdRequest $request
     * @return array
     */
    public function mobileArticleDetail(FindArticleByIdRequest $request)
    {

        $article = Apiato::call('Article@MobileFindArticleByIdAction', [$request]);

        return $this->transform($article, MobileArticleTransformer::class);
    }
}
