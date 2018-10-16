<?php

namespace App\Containers\Home\Actions;

use App\Containers\Advert\Models\Advert;
use App\Containers\Answer\Models\Answer;
use App\Containers\Guest\Models\Guest;
use App\Containers\Nav\Models\Nav;
use App\Containers\Topic\Models\Topic;
use App\Ship\Parents\Actions\Action;

class GetMobileIndexDataAction extends Action
{
    public function run()
    {

        $adverts = Advert::all();

        $linka_settings = get_setting('system_linka_index_top_settings');

        if ($linka_settings[0]) {

            $linkas = Guest::whereIn('id', $linka_settings[1])->whereStatus(1)->orderBy('created_at', 'desc')->get();

        } else {

            $linkas = Guest::withCount(['questions','topics'])->whereStatus(1)->get();
            $linkas = $linkas->sortBy(function ($item, $key){
                return $item['questions_count'] + $item['topics_count'];
            })->take(6);

        }

        $topic_settings = get_setting('system_topic_index_top_settings');

        if ($topic_settings[0]) {
            $topics = Topic::whereIn('id', $topic_settings[1])->whereStatus(1)->orderBy('created_at', 'desc')->get();
        } else {
            $topics = Topic::withCount(['appoints'])->whereStatus(1)->get();
            $topics = $topics->sortBy(function ($item, $key){
                return $item['appoints'];
            })->take(5);
        }

        $answers = Answer::orderBy('created_at','desc')->whereStatus(1)->take(3)->get();

        $navs = Nav::where('pid',0)->orderBy('created_at','desc')->take(7)->get();
        foreach ($navs as $nav){

            if(!$nav->children->isEmpty()){

                $first_child_id = $nav->children->first()->getHashedKey();

            }else{

                $first_child_id = null;

            }

            $nav['first_child_id'] = $first_child_id;
        }

        return [
            'adverts' => $adverts,
            'linkas'  => $linkas,
            'topics'  => $topics,
            'answers' => $answers,
            'navs'    => $navs,
        ];

    }
}
