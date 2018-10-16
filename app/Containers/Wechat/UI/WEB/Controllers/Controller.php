<?php

namespace App\Containers\Wechat\UI\WEB\Controllers;


use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Controllers\WebController;
use Illuminate\Http\Request;

/**
 * Class Controller
 *
 * @package App\Containers\Order\UI\API\Controllers
 */
class Controller extends WebController
{
    protected $wechat;

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        $this->wechat = \EasyWeChat::officialAccount();
    }


    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function wechatVerifyUrl()
    {
        $reslut = Apiato::call('Wechat@WechatVerifyUrlAction',[$this->wechat]);

        return $reslut;
    }

    /*
     * 设置菜单
     *
     *
     * */
    public function setWechatMenu()
    {
        $mobile_url = env('APP_MOBILE_URL', 'http://wx.qatest.elinkport.com');
        $buttons = [
            [
                "type" => "view",
                "name" => "链答主页",
                "url"  => $mobile_url . "/"
            ],
            [
                "name"       => "个人中心",
                "sub_button" => [
                    [
                        "type" => "view",
                        "name" => "个人中心",
                        "url"  => $mobile_url . "/#/user"
                    ],
                    [
                        "type" => "view",
                        "name" => "我预约的大咖",
                        "url"  => $mobile_url . "/#/user/userMake"
                    ],
                    [
                        "type" => "view",
                        "name" => "我问过的问题",
                        "url"  => $mobile_url . "/#/user/userAsked"
                    ], [
                        "type" => "view",
                        "name" => "联系客服",
                        "url"  => $mobile_url . "/#/user/feedBack"
                    ],
                ],
            ],
        ];

        return $this->wechat->menu->create($buttons);
    }

    /*
      * 菜单列表
      *
      *
      * */
    public function getWechatMenus()
    {
        $current_menus = $this->wechat->menu->current();
        $menus = $this->wechat->menu->list();

        return ['current' => $current_menus, 'menus' => $menus];
    }


    /*
     * 删除菜单
     *
     *
     * */
    public function deleteWechatMenu(Request $request)
    {
        if ($request->id) {
            $this->wechat->menu->delete($request->id);
        } else {
            $this->wechat->menu->delete(); // 全部
        }

    }


}
