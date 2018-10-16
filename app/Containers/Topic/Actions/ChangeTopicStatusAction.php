<?php

namespace App\Containers\Topic\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Exceptions\Exception;
use App\Ship\Parents\Requests\Request;

class ChangeTopicStatusAction extends Action
{
    public function run(Request $request)
    {

        try {

            $data = [
                'status' => $request->get('status'),
                'remark' => $request->get('remark'),
            ];

            $topic = Apiato::call('Topic@UpdateTopicTask', [$request->id, $data]);

            if ($topic->status == 1) {

                $title = '话题审核成功';
                $content = '恭喜您，您发布“' . $topic->title . '”话题，已经通过审核，现在您可以接受用户的预约了！！！';
                $remark = '感谢您的使用，话题审核成功，点击前往网站进行下一步流程。';

            } else {
                $title = '话题审核失败';
                $content = '非常抱歉，您发布“' . $topic->title . '”话题，未能通过审核，建议检查话题内容后，再次提交申请！如有不便，尽请谅解！';
                $remark = '感谢您的使用，话题审核失败，点击前往网站进行下一步流程。';
            }

            $url = env('APP_MOBILE_URL') . '/user/pageDaka';
            $temp_id = config('appoint-container.wechat_appoint_temp_id');


            send_wechat_temp_msg($topic->guest, $temp_id, $url, $title,'话题审核',$content, $remark);//微信审核消息

            return $topic;

        } catch (Exception $exception) {

            report($exception);
            throw new UpdateResourceFailedException();

        }
    }
}
