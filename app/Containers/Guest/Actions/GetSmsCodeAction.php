<?php

namespace App\Containers\Guest\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class GetSmsCodeAction extends Action
{
    public function run(Request $request)
    {
        $data = $request->sanitizeInput([
            'phone'
        ]);

        $code = Apiato::call('Guest@GetSmsCodeTask', [$data]);

        return $code;
    }
}
