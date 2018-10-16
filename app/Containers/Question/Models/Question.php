<?php

namespace App\Containers\Question\Models;

use App\Containers\Answer\Models\Answer;
use App\Containers\Guest\Models\Guest;
use App\Ship\Parents\Models\Model;

class Question extends Model
{
    protected $fillable = [
        'answer_id',
        'guest_id',
        'content',
    ];

    protected $attributes = [

    ];

    protected $hidden = [
        'answer_id',
        'guest_id',
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
    protected $resourceKey = 'questions';

    public function answer()
    {
        return $this->belongsTo(Answer::class);
    }

    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }
}
