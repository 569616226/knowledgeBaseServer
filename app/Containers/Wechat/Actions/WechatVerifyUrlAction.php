<?php

namespace App\Containers\Wechat\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Guest\Models\Guest;
use App\Ship\Parents\Actions\Action;

class WechatVerifyUrlAction extends Action
{
    public function run($officialAccount)
    {

        $officialAccount->server->push(function ($message) use ($officialAccount) {

            switch (array_key_exists('MsgType', $message) && $message['MsgType']) {

                case 'event':

                    switch (array_key_exists('Event', $message) && $message['Event']) {

                        case 'subscribe':

                            $wechat_subscribe_text = get_setting('system_wehchat_settings')[0];

                            $result = $this->create_wechat_user_data($officialAccount, $message['FromUserName']);

                            if ($result) {

                                return $wechat_subscribe_text;

                            } else {

                                return '用户注册失败，请取关后重试';

                            }

                            break;

                        default:

                            return '欢迎来到链答公众号';

                            break;
                    }

//                case 'text':
//                    return '收到文字消息';
//                    break;
//                case 'image':
//                    return '收到图片消息';
//                    break;
//                case 'voice':
//                    return '收到语音消息';
//                    break;
//                case 'video':
//                    return '收到视频消息';
//                    break;
//                case 'location':
//                    return '收到坐标消息';
//                    break;
//                case 'link':
//                    return '收到链接消息';
//                    break;
//                case 'file':
//                    return '收到文件消息';
                // ... 其它消息

                default:

                    return '欢迎来到链答公众号';

                    break;
            }

        });

        return $officialAccount->server->serve();
    }

    protected function create_wechat_user_data($app, $open_id)
    {

        $user = $app->user->get($open_id);

        /*  'subscribe'       => 1,
        'openid'          => 'ogjC0wZU5RfWW-uE2EKvVZ5GYmyU',
        'nickname'        => 'Dream',
        'sex'             => 1, 用户的性别，值为1时是男性，值为2时是女性，值为0时是未知
        'language'        => 'zh_CN',
        'city'            => '东莞',
        'province'        => '广东',
        'country'         => '中国',
        'headimgurl'      => 'http://thirdwx.qlogo.cn/mmopen/5ZQ3V8nVdKpb5icmiaUiaWQj0t5UahLFGd1DUoicczWWvGc5k7DNTZLDUnqggcT9yKicibcVZoaziatM2iaBq2sbB2E3kUuIClKVZoVx/132',
        'subscribe_time'  => 1526869218,
        'remark'          => '',
        'groupid'         => 0,
        'tagid_list'      =>
            array(),
        'subscribe_scene' => 'ADD_SCENE_QR_CODE',返回用户关注的渠道来源，ADD_SCENE_SEARCH 公众号搜索，ADD_SCENE_ACCOUNT_MIGRATION 公众号迁移，ADD_SCENE_PROFILE_CARD 名片分享，ADD_SCENE_QR_CODE 扫描二维码，ADD_SCENEPROFILE LINK 图文页内名称点击，ADD_SCENE_PROFILE_ITEM 图文页右上角菜单，ADD_SCENE_PAID 支付后关注，ADD_SCENE_OTHERS 其他
        'qr_scene'        => 0,
        'qr_scene_str'    => '',
        */
        if ($user['subscribe']) {

            $data = [

                'name'   => $user['nickname'],
                'avatar' => $user['headimgurl'],
                'city'   => $user['country'] . '-' . $user['province'] . '-' . $user['city'],
                'gender' => $user['sex']

            ];

            /*
             * 如果用户关注过，就更新用户信息
             *
             * 如果是第一次关注，就创建用户
             *
             * */
            if ($guest = Guest::where('open_id', $open_id)->first()) {

                Apiato::call('Guest@UpdateGuestTask', [$guest->id, $data]);

            } else {

                $data['status'] = 3;
                $data['open_id'] = $user['openid'];
                $data['password'] = \Illuminate\Support\Facades\Hash::make($user['openid']);

                Apiato::call('Guest@CreateGuestTask', [$data]);

            }

            return true;

        } else {

            return false;

        }
    }
}
