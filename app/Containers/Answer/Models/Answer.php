<?php

namespace App\Containers\Answer\Models;

use App\Containers\Guest\Models\Guest;
use App\Containers\Order\Models\Order;
use App\Containers\Question\Models\Question;
use App\Ship\Parents\Models\Model;

class Answer extends Model
{
    protected $fillable = [
        'name',
        'status',
        'readers',
        'price',
        'star',
        'guest_id',
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
    protected $resourceKey = 'answers';

    /*訂單*/
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /*答案*/
    public function question()
    {
        return $this->hasOne(Question::class);
    }

    /*问题创建者*/
    public function creator()
    {
        return $this->belongsToMany(Guest::class)->withPivot('is_creator')->wherePivot('is_creator', 1);
    }

    /*问题查看*/
    public function readers()
    {
        return $this->belongsToMany(Guest::class)->withPivot('is_creator')->wherePivot('is_reader', 1);
    }

    /*所有人 查看和创建*/
    public function guests()
    {
        return $this->belongsToMany(Guest::class)->withPivot('is_creator');
    }

}
