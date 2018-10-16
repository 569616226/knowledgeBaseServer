<?php

namespace App\Containers\Settings\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Settings\Models\Setting;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

/**
 * Class UpdateSettingAction
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class UpdateSettingAction extends Action
{

    /**
     * @param \App\Ship\Parents\Requests\Request $request
     *
     * @return  mixed
     */
    public function run(Request $request)
    {
        $data = $request->sanitizeInput([
            'key',
            'value'
        ]);

        $setting = Setting::where('key', $data['key'])->first();

        $setting = Apiato::call('Settings@UpdateSettingTask', [$setting, $data]);

        return $setting;
    }
}
