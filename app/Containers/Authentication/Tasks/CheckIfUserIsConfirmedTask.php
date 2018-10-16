<?php

namespace App\Containers\Authentication\Tasks;

use App\Containers\User\Models\User;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class CheckIfUserIsConfirmedTask extends Task
{
    private $user;

    public function run()
    {
        // is the config flag set?
        if (Config::get('authentication-container.require_email_confirmation')) {

            if (!$this->user) {
                return [
                    'status'  => false,
                    'msg' => "账号或密码输入有误",
                ];
            }elseif($this->user->is_frozen){
                return [
                    'status'  => false,
                    'msg' => "此账号已被冻结",
                ];
            }

            return $this->user;

        }
    }

    public function loginWithCredentials($name, $password)
    {
        if (Auth::attempt(['name' => $name, 'password' => $password])) {

            $this->user = Auth::user();
        }

    }

    public function setUser(User $user)
    {
        $this->user = $user;
    }
}
