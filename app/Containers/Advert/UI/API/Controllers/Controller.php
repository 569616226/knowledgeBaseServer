<?php

namespace App\Containers\Advert\UI\API\Controllers;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Advert\UI\API\Requests\CreateAdvertRequest;
use App\Containers\Advert\UI\API\Requests\DeleteAdvertRequest;
use App\Containers\Advert\UI\API\Requests\FindAdvertByIdRequest;
use App\Containers\Advert\UI\API\Requests\GetAllAdvertsRequest;
use App\Containers\Advert\UI\API\Requests\UpdateAdvertRequest;
use App\Containers\Advert\UI\API\Transformers\AdvertTransformer;
use App\Ship\Parents\Controllers\ApiController;

/**
 * Class Controller
 *
 * @package App\Containers\Advert\UI\API\Controllers
 */
class Controller extends ApiController
{
    /**
     * @param CreateAdvertRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createAdvert(CreateAdvertRequest $request)
    {
        $advert = Apiato::call('Advert@CreateAdvertAction', [$request]);

        return $this->created($this->transform($advert, AdvertTransformer::class), 200);
    }

    /**
     * @param FindAdvertByIdRequest $request
     * @return array
     */
    public function findAdvertById(FindAdvertByIdRequest $request)
    {
        $advert = Apiato::call('Advert@FindAdvertByIdAction', [$request]);
        return $this->transform($advert, AdvertTransformer::class);
    }

    /**
     * @param GetAllAdvertsRequest $request
     * @return array
     */
    public function getAllAdverts()
    {
        $adverts = Apiato::call('Advert@GetAllAdvertsAction', []);
        return $this->transform($adverts, AdvertTransformer::class);
    }

    /**
     * @param UpdateAdvertRequest $request
     * @return array
     */
    public function updateAdvert(UpdateAdvertRequest $request)
    {
        $advert = Apiato::call('Advert@UpdateAdvertAction', [$request]);
        return $this->transform($advert, AdvertTransformer::class);
    }

    /**
     * @param DeleteAdvertRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteAdvert(DeleteAdvertRequest $request)
    {
        return simple_respone(Apiato::call('Advert@DeleteAdvertAction', [$request]));
    }


}
