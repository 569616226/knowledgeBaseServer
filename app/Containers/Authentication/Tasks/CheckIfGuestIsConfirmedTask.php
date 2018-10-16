<?php

namespace App\Containers\Authentication\Tasks;

use App\Containers\Guest\Models\Guest;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Facades\Auth;

class CheckIfGuestIsConfirmedTask extends Task
{
    private $guest;

    public function run()
    {
        if (!$this->guest) {
            return [
                'status'  => false,
                'msg' => "账号信息获取有误",
            ];
        }else{
            return $this->guest;
        }
    }

    public function loginWithCredentials($name, $password)
    {

        if (Auth::guard('mobile_web')->attempt(['name' => $name, 'password' => $password])) {
            $this->guest = Auth::guard('mobile_web')->user();
        }

    }

    public function setGuest(Guest $guest)
    {
        $this->guest = $guest;
    }
}
