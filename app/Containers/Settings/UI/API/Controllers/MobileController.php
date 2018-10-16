<?php

namespace App\Containers\Settings\UI\API\Controllers;


use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Settings\UI\API\Requests\Mobile\FindSettingByKeyRequest;
use App\Containers\Settings\UI\API\Transformers\SettingTransformer;
use App\Ship\Parents\Controllers\ApiController;

/**
 * Class Controller
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class MobileController extends ApiController
{


    public function getSettingByKey(FindSettingByKeyRequest $request)
    {
        $setting = Apiato::call('Settings@FindSettingByKeyAction', [$request]);

        return $this->transform($setting, SettingTransformer::class);
    }


}
