<?php

namespace App\Containers\Settings\UI\API\Controllers;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Settings\UI\API\Requests\CreateSettingRequest;
use App\Containers\Settings\UI\API\Requests\DeleteSettingRequest;
use App\Containers\Settings\UI\API\Requests\FindSettingByKeyRequest;
use App\Containers\Settings\UI\API\Requests\GetAllSettingsRequest;
use App\Containers\Settings\UI\API\Requests\UpdateSettingRequest;
use App\Containers\Settings\UI\API\Transformers\SettingTransformer;
use App\Ship\Parents\Controllers\ApiController;

/**
 * Class Controller
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class Controller extends ApiController
{


    public function getSettingByKey(FindSettingByKeyRequest $request)
    {
        $setting = Apiato::call('Settings@FindSettingByKeyAction', [$request]);

        return $this->transform($setting, SettingTransformer::class);
    }

    /**


    /**
     * Updates an existing setting
     *
     * @param UpdateSettingRequest $request
     *
     * @return mixed
     */
    public function updateSetting(UpdateSettingRequest $request)
    {
        $setting = Apiato::call('Settings@UpdateSettingAction', [$request]);

        return $this->transform($setting, SettingTransformer::class);
    }


}
