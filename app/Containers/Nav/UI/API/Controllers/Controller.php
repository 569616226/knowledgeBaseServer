<?php

namespace App\Containers\Nav\UI\API\Controllers;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Nav\UI\API\Requests\CreateNavRequest;
use App\Containers\Nav\UI\API\Requests\DeleteNavRequest;
use App\Containers\Nav\UI\API\Requests\FindNavByIdRequest;
use App\Containers\Nav\UI\API\Requests\GetAllNavsRequest;
use App\Containers\Nav\UI\API\Requests\GetChildrenNavByIdRequest;
use App\Containers\Nav\UI\API\Requests\UpdateChildrenNavRequest;
use App\Containers\Nav\UI\API\Requests\UpdateNavRequest;
use App\Containers\Nav\UI\API\Transformers\NavTransformer;
use App\Ship\Parents\Controllers\ApiController;

/**
 * Class Controller
 *
 * @package App\Containers\Nav\UI\API\Controllers
 */
class Controller extends ApiController
{
    /**
     * @param CreateNavRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createNav(CreateNavRequest $request)
    {
        $nav = Apiato::call('Nav@CreateNavAction', [$request]);

        return $this->created($this->transform($nav, NavTransformer::class), 200);
    }

    /**
     * @param FindNavByIdRequest $request
     * @return array
     */
    public function findNavById(FindNavByIdRequest $request)
    {
        $nav = Apiato::call('Nav@FindNavByIdAction', [$request]);

        return $this->transform($nav, NavTransformer::class);
    }

    /**
     * @param GetChildrenNavByIdRequest $request
     * @return array
     */
    public function getChildrenNavById(GetChildrenNavByIdRequest $request)
    {
        $navs = Apiato::call('Nav@GetChildrenNavByIdAction', [$request]);

        return $this->transform($navs, NavTransformer::class);
    }

    /**
     * @param GetAllNavsRequest $request
     * @return array
     */
    public function getAllNavs(GetAllNavsRequest $request)
    {
        $navs = Apiato::call('Nav@GetAllNavsAction');

        return $this->transform($navs, NavTransformer::class);
    }

    /**
     * @param UpdateNavRequest $request
     * @return array
     */
    public function updateNav(UpdateNavRequest $request)
    {
        $nav = Apiato::call('Nav@UpdateNavAction', [$request]);

        return $this->transform($nav, NavTransformer::class);
    }

    /**
     * @param UpdateNavRequest $request
     * @return array
     */
    public function updateChildrenNav(UpdateChildrenNavRequest $request)
    {
        $result = Apiato::call('Nav@UpdateChildrenNavAction', [$request]);

        return simple_respone($result);
    }

    /**
     * @param DeleteNavRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteNav(DeleteNavRequest $request)
    {
        return Apiato::call('Nav@DeleteNavAction', [$request]);

    }

}
