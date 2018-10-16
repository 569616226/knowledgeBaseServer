<?php

namespace App\Containers\Article\UI\API\Controllers;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Article\UI\API\Requests\ChangeStatusRequest;
use App\Containers\Article\UI\API\Requests\FindArticleByIdRequest;
use App\Containers\Article\UI\API\Requests\GetAllArticlesRequest;
use App\Containers\Article\UI\API\Transformers\ArticleTransformer;
use App\Ship\Parents\Controllers\ApiController;

/**
 * Class Controller
 *
 * @package App\Containers\Article\UI\API\Controllers
 */
class Controller extends ApiController
{

    /**
     * @param FindArticleByIdRequest $request
     * @return array
     */
    public function findArticleById(FindArticleByIdRequest $request)
    {
        $article = Apiato::call('Article@FindArticleByIdAction', [$request]);

        return $this->transform($article, ArticleTransformer::class);
    }

    /**
     * @param GetAllArticlesRequest $request
     * @return array
     */
    public function getAllArticles(GetAllArticlesRequest $request)
    {
        $articles = Apiato::call('Article@GetAllArticlesAction');

        return $this->transform($articles, ArticleTransformer::class);
    }


    public function changeArticleStatus(ChangeStatusRequest $request)
    {
        $article = Apiato::call('Article@ChangeArticleStatusAction', [$request]);
        return $this->transform($article, ArticleTransformer::class);
    }

}
