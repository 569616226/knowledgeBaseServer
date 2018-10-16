<?php

namespace App\Containers\Guest\Tasks;

use App\Containers\Guest\Exceptions\CheckSmsCodeFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Illuminate\Support\Facades\Cache;

class CheckSmsCodeTask extends Task
{

    public function run(array $data)
    {

        $phoneNumber = $data['phone'];
        $sms_code = $data['sms_code'];

        try {
            if (Cache::get(auth_user()->open_id . 'sms_code') && $sms_code == Cache::pull(auth_user()->open_id . 'sms_code')) {

                auth_user()->phone = $phoneNumber;
                auth_user()->save();

                return ['status' => true, 'msg' => '操作成功'];
            } else {
                return ['status' => false, 'msg' => '验证码错误'];
            }
        } catch (Exception $exception) {
            report($exception);
            throw new CheckSmsCodeFailedException();
        }
    }


}
