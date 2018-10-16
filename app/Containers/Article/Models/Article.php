<?php

namespace App\Containers\Article\Models;

use App\Containers\Comment\Models\Comment;
use App\Containers\Guest\Models\Guest;
use App\Ship\Parents\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'guest_id',
        'title',
        'content',
        'cover',
        'status',
        'remark',
        'readers',
        'like',
        'auditor',
        'audit_time',
    ];

    protected $attributes = [

    ];

    protected $hidden = [

    ];

    protected $casts = [
        'like' => 'array',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'audit_time',
    ];

    /**
     * A resource key to be used by the the JSON API Serializer responses.
     */
    protected $resourceKey = 'articles';

    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
