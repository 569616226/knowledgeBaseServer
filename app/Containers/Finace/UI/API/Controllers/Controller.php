<?php

namespace App\Containers\Finace\UI\API\Controllers;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Finace\UI\API\Requests\CreateFinaceRequest;
use App\Containers\Finace\UI\API\Requests\DeleteFinaceRequest;
use App\Containers\Finace\UI\API\Requests\FindFinaceByIdRequest;
use App\Containers\Finace\UI\API\Requests\GetAllFinacesRequest;
use App\Containers\Finace\UI\API\Requests\GetMyFinacesRequest;
use App\Containers\Finace\UI\API\Requests\UpdateFinaceRequest;
use App\Containers\Finace\UI\API\Transformers\FinaceTransformer;
use App\Containers\Finace\UI\API\Transformers\MobileFinaceTransformer;
use App\Ship\Parents\Controllers\ApiController;

/**
 * Class Controller
 *
 * @package App\Containers\Finace\UI\API\Controllers
 */
class Controller extends ApiController
{

    /**
     * @param FindFinaceByIdRequest $request
     * @return array
     */
    public function findFinaceById(FindFinaceByIdRequest $request)
    {
        $finace = Apiato::call('Finace@FindFinaceByIdAction', [$request]);

        return $this->transform($finace, FinaceTransformer::class);
    }

    /**
     * @param GetAllFinacesRequest $request
     * @return array
     */
    public function getAllFinaces(GetAllFinacesRequest $request)
    {
        $finaces = Apiato::call('Finace@GetAllFinacesAction', [$request]);

        return $this->transform($finaces, FinaceTransformer::class);
    }

    /**
     * @param GetMyFinacesRequest $request
     * @return array
     */
    public function getMyFinaces(GetMyFinacesRequest $request)
    {
        $finaces = Apiato::call('Finace@GetMyFinacesAction', [$request]);

        return $this->transform($finaces, MobileFinaceTransformer::class);
    }

}
