<?php

namespace App\Containers\Menu\UI\API\Controllers;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Menu\UI\API\Requests\CreateMenuRequest;
use App\Containers\Menu\UI\API\Requests\DeleteMenuRequest;
use App\Containers\Menu\UI\API\Requests\FindMenuByIdRequest;
use App\Containers\Menu\UI\API\Requests\GetAllMenusRequest;
use App\Containers\Menu\UI\API\Requests\GetUserMenusRequest;
use App\Containers\Menu\UI\API\Requests\UpdateMenuRequest;
use App\Containers\Menu\UI\API\Transformers\MenuTransformer;
use App\Ship\Parents\Controllers\ApiController;

/**
 * Class Controller
 *
 * @package App\Containers\Menu\UI\API\Controllers
 */
class Controller extends ApiController
{
    /**
     * @param CreateMenuRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createMenu(CreateMenuRequest $request)
    {
        $menu = Apiato::call('Menu@CreateMenuAction', [$request]);

        return $this->created($this->transform($menu, MenuTransformer::class), 200);
    }

    /**
     * @param FindMenuByIdRequest $request
     * @return array
     */
    public function findMenuById(FindMenuByIdRequest $request)
    {
        $menu = Apiato::call('Menu@FindMenuByIdAction', [$request]);

        return $this->transform($menu, MenuTransformer::class);
    }

    /**
     * @param GetAllMenusRequest $request
     * @return array
     */
    public function getAllMenus(GetAllMenusRequest $request)
    {
        $menus = Apiato::call('Menu@GetAllMenusAction', [$request]);

        return $this->transform($menus, MenuTransformer::class);
    }

    /**
     * @param GetUserMenusRequest $request
     * @return array
     */
    public function getUserMenus(GetUserMenusRequest $request)
    {
        $menus = Apiato::call('Menu@GetUserMenusAction', [$request]);

        return $this->transform($menus, MenuTransformer::class);
    }

    /**
     * @param UpdateMenuRequest $request
     * @return array
     */
    public function updateMenu(UpdateMenuRequest $request)
    {
        $menu = Apiato::call('Menu@UpdateMenuAction', [$request]);

        return $this->transform($menu, MenuTransformer::class);
    }


    /**
     * @param DeleteMenuRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteMenu(DeleteMenuRequest $request)
    {
        Apiato::call('Menu@DeleteMenuAction', [$request]);


        return $this->accepted([
            'status' => true,
            'msg'    => "操作成功",
        ], 202);
    }
}
