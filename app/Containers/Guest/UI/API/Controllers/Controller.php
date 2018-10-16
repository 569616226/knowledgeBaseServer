<?php

namespace App\Containers\Guest\UI\API\Controllers;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Guest\UI\API\Requests\AdminUploadImageRequest;
use App\Containers\Guest\UI\API\Requests\ChangeLinkaStatusRequest;
use App\Containers\Guest\UI\API\Requests\FindGuestByIdRequest;
use App\Containers\Guest\UI\API\Requests\FindLinkaByIdRequest;
use App\Containers\Guest\UI\API\Requests\GetAllGuestsRequest;
use App\Containers\Guest\UI\API\Requests\GetAllLinkasRequest;
use App\Containers\Guest\UI\API\Requests\Mobile\UpdateGuestRequest;
use App\Containers\Guest\UI\API\Requests\SyncGuestGroupsRequest;
use App\Containers\Guest\UI\API\Requests\SyncGuestNavsRequest;
use App\Containers\Guest\UI\API\Transformers\GuestTransformer;
use App\Containers\Guest\UI\API\Transformers\LinkaTransformer;
use App\Ship\Parents\Controllers\ApiController;

/**
 * Class Controller
 *
 * @package App\Containers\Guest\UI\API\Controllers
 */
class Controller extends ApiController
{


    /**
     * @param AdminUploadImageRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function adminUploadImage(AdminUploadImageRequest $request)
    {
        $img_url = Apiato::call('Guest@UploadImageAction', [$request]);

        return $this->accepted($img_url, 200);
    }

    /**
     * @param FindGuestByIdRequest $request
     * @return array
     */
    public function findGuestById(FindGuestByIdRequest $request)
    {
        $guest = Apiato::call('Guest@FindGuestByIdAction', [$request]);

        return $this->transform($guest, GuestTransformer::class);
    }

    /**
     * @param FindGuestByIdRequest $request
     * @return array
     */
    public function findLinkaById(FindLinkaByIdRequest $request)
    {
        $guest = Apiato::call('Guest@FindGuestByIdAction', [$request]);

        return $this->transform($guest, LinkaTransformer::class);
    }


    /**
     * @param ChangeLinkaStatusRequest $request
     * @return array
     */
    public function changeLinkaStatus(ChangeLinkaStatusRequest $request)
    {

        $guest = Apiato::call('Guest@ChangeLinkaStatusAction', [$request]);

        return $this->transform($guest, LinkaTransformer::class);
    }

    /**
     * @param   GetAllGuestsRequest
     *
     * @return array
     */
    public function getAllGuests(GetAllGuestsRequest $request)
    {
        $guests = Apiato::call('Guest@GetAllGuestsAction');

        return $this->transform($guests, GuestTransformer::class);
    }

    /**
     * @param GetAllLinkasRequest
     * @return array
     */
    public function getAllLinkas(GetAllLinkasRequest $request)
    {
        $linkas = Apiato::call('Guest@GetAllLinkasAction');

        return $this->transform($linkas, LinkaTransformer::class);
    }
    /**
     * @param GetAllLinkasRequest
     * @return array
     */
    public function getAllLinkaCheckList(GetAllLinkasRequest $request)
    {
        $linkas = Apiato::call('Guest@GetAllLinkaCheckListAction');

        return $this->transform($linkas, LinkaTransformer::class);
    }

    /**
     * @param UpdateGuestRequest $request
     * @return array
     */
    public function updateGuest(UpdateGuestRequest $request)
    {
        $guest = Apiato::call('Guest@UpdateGuestAction', [$request]);

        return $this->transform($guest, LinkaTransformer::class);
    }

    /**
     * @param UpdateGuestRequest $request
     * @return array
     */
    public function syncGuestGroups(SyncGuestGroupsRequest $request)
    {
        $guest = Apiato::call('Guest@SyncGuestGroupsAction', [$request]);

        return $this->transform($guest, GuestTransformer::class, ['groups']);
    }

    /**
     * @param UpdateGuestRequest $request
     * @return array
     */
    public function syncGuestNavs(SyncGuestNavsRequest $request)
    {
        $guest = Apiato::call('Guest@SyncGuestNavsAction', [$request]);

        return $this->transform($guest, GuestTransformer::class, ['navs']);
    }

}
