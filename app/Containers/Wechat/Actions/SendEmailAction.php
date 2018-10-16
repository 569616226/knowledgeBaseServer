<?php

namespace App\Containers\Wechat\Actions;

use App\Ship\Parents\Actions\Action;
use Mail;
use App\Ship\Parents\Requests\Request;


class SendEmailAction extends Action
{
    public function run(Request $request)
    {

        // Mail::send()的返回值为空，所以可以其他方法进行判断
        Mail::raw($request->get('content'), function ($message) {

            $message->to(env('MAIL_TO_SUPPORT_ADDRESS'))->subject('链答意见反馈');

        });

        // 返回的一个错误数组，利用此可以判断是否发送成功
        if ( Mail::failures() ) {

            return simple_respone(false , implode(',',Mail::failures()) . '邮件发送失败' ) ;

        } else {

            return simple_respone(true);
        }

    }
}
