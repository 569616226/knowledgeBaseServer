<?php

namespace App\Containers\Guest\Tasks;

use App\Containers\Guest\Exceptions\GetSmsCodeFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Illuminate\Support\Facades\Cache;
use Qcloud\Sms\SmsSingleSender;

class GetSmsCodeTask extends Task
{

    public function run(array $data)
    {

        $appid = env('QCLOUDSMS_APPID', 122014);
        $appkey = env('QCLOUDSMS_APPKEY', 1400093185);
        $templId = env('QCLOUDSMS_TEMPLID', '020789c3d1034ba6d4e676465a1e5dcd');
        $sms_code = $this->getSmsCode();
        $phoneNumber = $data['phone'];

        try {
            $sender = new SmsSingleSender($appid, $appkey);
            $params = [$sms_code, 10];// 假设模板内容为：测试短信，{1}，{2}，{3}，上学。
            $result = $sender->sendWithParam("86", $phoneNumber, $templId,
                $params, "", "", "");
            $rsp = json_decode($result);

            if ($rsp->result == 0 && $rsp->errmsg == 'OK') {

                Cache::put(auth_user()->open_id . 'sms_code', $sms_code, 10);

                return ['sms_code' => $sms_code];

            } else {

                return ['error_code' => $rsp->result, 'error_msg' => $rsp->errmsg];
            }

        } catch (Exception $exception) {
            report($exception);
            throw new GetSmsCodeFailedException();
        }
    }

    private function getSmsCode()
    {
        return rand(1000, 9999);
    }
}
