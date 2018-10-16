<?php

namespace App\Containers\Comment\Models;

use App\Containers\Article\Models\Article;
use App\Containers\Guest\Models\Guest;
use App\Ship\Parents\Models\Model;

class Comment extends Model
{
    protected $fillable = [
        'guest_id',
        'article_id',
        'content',
    ];

    protected $attributes = [

    ];

    protected $hidden = [
    ];

    protected $casts = [
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * A resource key to be used by the the JSON API Serializer responses.
     */
    protected $resourceKey = 'comments';

    /*评论者*/
    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }

    /*文章*/
    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
