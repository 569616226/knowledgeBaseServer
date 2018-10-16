<?php

namespace App\Containers\Guest\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class UploadImageAction extends Action
{
    public function run(Request $request)
    {

        $img = $request->file('img_url');

        $img_url = Apiato::call('Guest@UploadImageTask', [
            ['img_url' => $img]
        ]);

        return $img_url;
    }
}
