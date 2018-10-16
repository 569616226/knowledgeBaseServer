<?php

namespace App\Containers\Authentication\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\User\Models\User;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

/**
 * Class ProxyApiLoginAction.
 */
class ProxyApiLoginAction extends Action
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
        ];

        // check if user email is confirmed only if that feature is enabled.
        $loginResponseContent = Apiato::call('Authentication@CheckIfUserIsConfirmedTask', [],
            [['loginWithCredentials' => [$requestData['username'], $requestData['password']]]]);

        if($loginResponseContent instanceof User){//登录成功
            $responseContent = Apiato::call('Authentication@CallOAuthServerTask', [$requestData]);

            $refreshCookie = Apiato::call('Authentication@MakeRefreshCookieTask', [$responseContent['refresh_token']]);

            return [
                'response-content' => $responseContent,
                'refresh-cookie'   => $refreshCookie,
            ];

        }else{//登录失败

            return $loginResponseContent;

        }

    }
}
