<?php

namespace App\Containers\Guest\UI\API\Transformers\Mobile;

use App\Containers\Answer\Models\Answer;
use App\Containers\AppointAppraise\Models\AppointAppraise;
use App\Containers\AppointAppraise\UI\API\Transformers\AppointAppraiseTransformer;
use App\Containers\Article\UI\API\Transformers\ArticleTransformer;
use App\Containers\Guest\Models\Guest;
use App\Containers\Home\UI\API\Transformers\AnswerTransformer;
use App\Containers\Topic\UI\API\Transformers\TopicTransformer;
use App\Ship\Parents\Transformers\Transformer;

class LinkaTransformer extends Transformer
{
    /**
     * @var  array
     */
    protected $defaultIncludes = [

    ];

    /**
     * @var  array
     */
    protected $availableIncludes = [
        'topics',
        'answers',
        'articles',
    ];

    /**
     * @param Guest $entity
     *
     * @return array
     */
    public function transform(Guest $entity)
    {

        $topics = $entity->topics;
        $appointids = [];

        foreach ($topics as $topic) {

            $appoint_ids = $topic->appoints()->whereStatus(5)->get()->pluck('id')->toArray();

            $appointids = array_merge($appointids, $appoint_ids);
        }


        $answers = $entity->questions()->whereNotNull('content')->get()->count();
        $helpers = count($appointids) + $answers;

        /*喜欢大咖的人数*/
        $guests = Guest::all();
        $likes = $guests->filter(function ($value, $key) use ($entity) {
            return is_array($value->like_linkas) && in_array($entity->id, $value->like_linkas);
        })->count();

        $response = [
            'object'         => 'Guest',
            'id'             => $entity->getHashedKey(),
            'real_id'        => $entity->id,
            'real_name'      => $entity->real_name,
            'city'           => $entity->city,
            'single_profile' => $entity->single_profile,
            'office'         => $entity->office,
            'cover'          => $entity->cover,
            'avatar'         => $entity->avatar,
            'location'       => $entity->location,
            'profile'        => html_entity_decode(stripslashes($entity->profile)),
            'helpers'        => $helpers,
            'likes'          => $likes,
            'is_like'        => in_array($entity->id, auth_user()->like_linkas ?? []),
            'created_at'     => $entity->created_at->toDateTimeString(),
            'updated_at'     => $entity->updated_at->toDateTimeString(),
        ];

        /*返回话题约见评论*/
        if ($appointids) {

            $appoint_appraises = AppointAppraise::whereIn('appoint_id', $appointids)->get();

            if ($appoint_appraises) {

                /*获取评价人的头像和名字，获取话题的名字*/
                $appointAppraises = [];
                foreach ($appoint_appraises as $appoint_appraise) {

                    $appointAppraise['guest_name'] = $appoint_appraise->guest->name;
                    $appointAppraise['guest_avatar'] = $appoint_appraise->guest->avatar;
                    $appointAppraise['topic_name'] = $appoint_appraise->appoint->topic->title;
                    $appointAppraise['content'] = $appoint_appraise->content;
                    $appointAppraise['star'] = $appoint_appraise->star;
                    $appointAppraise['degree'] = $appoint_appraise->star;

                    array_push($appointAppraises,$appointAppraise);

                }

                $response = array_merge($response, [

                    'appoint_appraises' => $appointAppraises

                ]);

            }

        }

        return $response;
    }

    public function includeArticles(Guest $entity)
    {
        return $this->collection($entity->articles()->orderBy('created_at', 'desc')->whereStatus(1)->get(), new ArticleTransformer());
    }

    public function includeTopics(Guest $entity)
    {
        return $this->collection($entity->topics()->orderBy('created_at', 'desc')->whereStatus(1)->get(), new TopicTransformer());
    }

    public function includeAnswers(Guest $entity)
    {
        $answer_ids = $entity->questions->pluck('answer_id')->toArray();
        $answers = Answer::whereIn('id', $answer_ids)->whereIn('status',[0,1,2])->orderBy('created_at', 'desc')->get();

        return $this->collection($answers, new AnswerTransformer());
    }


}
