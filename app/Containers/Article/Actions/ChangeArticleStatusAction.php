<?php

namespace App\Containers\Article\Actions;

use App\Containers\Article\Models\Article;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Exceptions\Exception;
use App\Ship\Parents\Requests\Request;

class ChangeArticleStatusAction extends Action
{
    public function run(Request $request)
    {
        $status = $request->get('status');
        $remark = $request->get('remark');

        try {
            $article = Article::find($request->id);
            $article->update([
                'status' => $status,
                'remark' => $remark,
            ]);
            $article->save();

            if ($status) {
                $title = '文章审核成功';
                $content = '您发表的“' . $article->title . '” 文章，已经通过人工审核，感谢您的投稿！';
                $remark   = '感谢您的使用，文章审核已经通过，点击前往网站进行下一步审核流程。';
            } else {
                $title = '文章审核失败';
                $content = '非常抱歉，您发表的“' . $article->title . '”文章，未能通过审核，建议检查文章内容后，再次提交申请！如有不便，尽请谅解！';
                $remark   = '感谢您的使用，文章审核未通过，点击前往网站查看详情。';
            }

            $url = env('APP_MOBILE_URL') . '/#/essay/'.$article->getHashedKey();
            $temp_id = config('appoint-container.wechat_appoint_temp_id');

            send_wechat_temp_msg($article->guest, $temp_id, $url, $title,'文章审核',$content,$remark);//微信审核消息

            return $article;

        } catch (Exception $exception) {

            report($exception);
            throw new UpdateResourceFailedException();
        }
    }
}
