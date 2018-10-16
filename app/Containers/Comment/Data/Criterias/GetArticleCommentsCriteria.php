<?php

namespace App\Containers\Comment\Data\Criterias;

use App\Ship\Parents\Criterias\Criteria;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

/**
 * Class AdminsCriteria.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class GetArticleCommentsCriteria extends Criteria
{
    private $articleId;

    public function __construct($articleId)
    {
        $this->articleId = $articleId;
    }

    public function apply($model, PrettusRepositoryInterface $repository)
    {
        return $model->where('article_id', $this->articleId);
    }
}
