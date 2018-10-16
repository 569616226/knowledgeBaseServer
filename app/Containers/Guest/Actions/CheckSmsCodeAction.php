<?php

namespace App\Containers\Guest\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class CheckSmsCodeAction extends Action
{
    public function run(Request $request)
    {
        $data = $request->sanitizeInput([
            'phone',
            'sms_code'
        ]);

        $code = Apiato::call('Guest@CheckSmsCodeTask', [$data]);

        return $code;
    }
}
