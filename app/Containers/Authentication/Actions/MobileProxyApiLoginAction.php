<?php

namespace App\Containers\Authentication\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Guest\Models\Guest;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

/**
 * Class ProxyApiLoginAction.
 */
class MobileProxyApiLoginAction extends Action
{

    /**
     * @param \App\Ship\Parents\Requests\Request $request
     * @param                                    $clientId
     * @param                                    $clientPassword
     *
     * @return  array
     */
    public function run(Request $request, $clientId, $clientPassword)
    {

        $requestData = [
            'grant_type'    => 'password',
            'client_id'     => $clientId,
            'client_secret' => $clientPassword,
            'username'      => $request->name,
            'password'      => $request->password,
            'scope'         => '',
            'provider'      => 'guests'

        ];

        // check if user email is confirmed only if that feature is enabled.
        $loginResponseContent = Apiato::call('Authentication@CheckIfGuestIsConfirmedTask', [],
            [['loginWithCredentials' => [$requestData['username'], $requestData['password']]]]);

        if($loginResponseContent instanceof Guest){//登录成功
            $responseContent = Apiato::call('Authentication@CallOAuthServerTask', [$requestData]);

            return [
                'response-content' => $responseContent,
            ];

        }else{//登录失败

            return $loginResponseContent;

        }
    }
}
