<?php

namespace App\Containers\Guest\Actions;

use App\Containers\Guest\Models\Guest;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Exceptions\Exception;
use App\Ship\Parents\Requests\Request;

class ChangeLinkaStatusAction extends Action
{
    public function run(Request $request)
    {
        $status = $request->get('status');
        $remark = $request->get('remark');

        try {

            $guest = Guest::find($request->id);

            $guest->update([
                'status' => $status,
                'remark' => $remark,
                'auditor' => $request->user()->name,
                'audit_time' => now()->timestamp,
            ]);

            $guest->save();

            if ($status) {
                $title = '大咖审核成功';
                $content = config('guest-container.linka_wechat_temp_content_success');
                $remark   = '感谢您的使用，审核已经通过，点击前往网站进行下一步审核流程。';
            } else {
                $title = '大咖审核失败';
                $content = config('guest-container.linka_wechat_temp_content_fail');
                $remark   = '感谢您的使用，审核未通过，点击前往网站查看详情。';
            }

            $url = env('APP_MOBILE_URL') . '/#/user/pageDaka';
            $temp_id = config('appoint-container.wechat_appoint_temp_id');
            $type_name =  '大咖审核';

            send_wechat_temp_msg($guest, $temp_id, $url, $title,$type_name,$content,$remark);//微信审核消息

            return $guest;

        } catch (Exception $exception) {

            report($exception);
            throw new UpdateResourceFailedException();

        }

    }
}
