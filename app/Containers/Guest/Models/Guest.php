<?php

namespace App\Containers\Guest\Models;

use App\Containers\Answer\Models\Answer;
use App\Containers\Appoint\Models\Appoint;
use App\Containers\AppointCase\Models\AppointCase;
use App\Containers\Article\Models\Article;
use App\Containers\Authorization\Traits\GuestAuthorizationTrait;
use App\Containers\Chat\Models\Chat;
use App\Containers\Finace\Models\Finace;
use App\Containers\Group\Models\Group;
use App\Containers\Message\Models\Message;
use App\Containers\Nav\Models\Nav;
use App\Containers\Order\Models\Order;
use App\Containers\Question\Models\Question;
use App\Containers\Topic\Models\Topic;
use App\Ship\Parents\Models\GuestModel;

class Guest extends GuestModel
{

    use GuestAuthorizationTrait;

    protected $fillable = [
        'open_id',
        'name',
        'password',
        'real_name',
        'avatar',
        'phone',
        'email',
        'we_name',
        'city',
        'single_profile',
        'office',
        'cover',
        'location',
        'card_id',
        'card_pic',
        'referee',
        'remark',
        'audit_time',
        'auditor',
        'profile',
        'status',
        'viewed_linkas',
        'like_linkas',
        'wallets',
        'gender'
    ];

    protected $attributes = [

    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'viewed_linkas' => 'array',
        'like_linkas'   => 'array',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'audit_time',
    ];

    /**
     * A resource key to be used by the the JSON API Serializer responses.
     */
    protected $resourceKey = 'guests';

    /**
     * 修改认证时的默认username字段为tel
     */
    public function findForPassport($username) {
        return $this->where('name', $username)->first();
    }

    /*用户组*/
    public function groups()
    {
        return $this->belongsToMany(Group::class);
    }

    /*订单*/
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /*约见方案*/
    public function appoint_cases()
    {
        return $this->hasMany(AppointCase::class);
    }

    /*我的提问*/
    public function my_answers()
    {
        return $this->belongsToMany(Answer::class)->withPivot('is_creator')->wherePivot('is_creator', 1);
    }

    /*我查看的问题*/
    public function read_answers()
    {
        return $this->belongsToMany(Answer::class)->withPivot('is_creator')->wherePivot('is_reader', 1);
    }

    /*我查看的问题*/
    public function answers()
    {
        return $this->belongsToMany(Answer::class)->withPivot('is_creator');
    }

    /*大咖领域*/
    public function navs()
    {
        return $this->belongsToMany(Nav::class);
    }

    /*话题*/
    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

    /*文章*/
    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    /*答案*/
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    /*约见*/
    public function appoints()
    {
        return $this->hasMany(Appoint::class);
    }

    /*系统，群发消息*/
    public function messages()
    {
        return $this->belongsToMany(Message::class);
    }

    /*我的所有私信*/
    public function chats()
    {
        return $this->belongsToMany(Chat::class)->withPivot('is_sender')->withPivot('is_last')->withPivot('reciver_or_sender_id');
    }

    /*我喜欢的大咖*/
    public function getGuestLikeLinkasAttribute()
    {
        return $this->like_linkas ? Guest::whereIn('id', $this->like_linkas)->paginate() : collect([]);
    }

    /*我看过的大咖*/
    public function getGuestViewedLinkasAttribute()
    {
        return $this->viewed_linkas ? Guest::whereIn('id', $this->viewed_linkas)->paginate() : collect([]);
    }

    /* 我的问题未完成*/
    public function getLinkaNoQuestionAnswersAttribute()
    {
        $answer_ids = $this->questions->pluck('answer_id')->toArray();
        $answers = Answer::whereIn('id', $answer_ids)->whereIn('status', [0, 3])->orderBy('created_at','desc')->paginate();

        return $answers;
    }

    /* 我的问题-完成*/
    public function getLinkaHasQuestionAnswersAttribute()
    {
        $answer_ids = $this->questions->pluck('answer_id')->toArray();
        $answers = Answer::whereIn('id', $answer_ids)->whereIn('status', [1, 2])->orderBy('created_at','desc')->paginate();

        return $answers;
    }

    /*交易记录*/
    public function finaces()
    {
        return $this->hasMany(Finace::class);
    }
}
