<?php

namespace App\Containers\Settings\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

/**
 * Class CreateSettingAction
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class FindSettingByKeyAction extends Action
{

    /**
     * @param \App\Ship\Parents\Requests\Request $request
     *
     * @return  mixed
     */
    public function run(Request $request)
    {
        $data = $request->sanitizeInput([
            'key'
        ]);

        $setting = Apiato::call('Settings@FindSettingByKeyTask', [$data['key']]);

        return $setting;
    }
}
