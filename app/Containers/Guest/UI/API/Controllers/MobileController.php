<?php

namespace App\Containers\Guest\UI\API\Controllers;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Guest\UI\API\Requests\Mobile\CheckSmsCodeRequest;
use App\Containers\Guest\UI\API\Requests\Mobile\FindLinkaByIdRequest;
use App\Containers\Guest\UI\API\Requests\Mobile\GetGuestLikeLinkasRequest;
use App\Containers\Guest\UI\API\Requests\Mobile\GetGuestViewedLinkasRequest;
use App\Containers\Guest\UI\API\Requests\Mobile\GetSmsCodeRequest;
use App\Containers\Guest\UI\API\Requests\Mobile\GuestLikeLinkaRequest;
use App\Containers\Guest\UI\API\Requests\Mobile\ToBeLinkaRequest;
use App\Containers\Guest\UI\API\Requests\Mobile\UpdateGuestRequest;
use App\Containers\Guest\UI\API\Requests\Mobile\UploadImageRequest;
use App\Containers\Guest\UI\API\Transformers\GuestTransformer;
use App\Containers\Guest\UI\API\Transformers\LinkaTransformer as AdminLinkaTransformer;
use App\Containers\Guest\UI\API\Transformers\Mobile\LinkaTransformer;
use App\Ship\Parents\Controllers\ApiController;

/**
 * Class Controller
 *
 * @package App\Containers\Guest\UI\API\Controllers
 */
class MobileController extends ApiController
{
    /**
     * @param FindLinkaByIdRequest $request
     * @return array
     */
    public function findLinkaById(FindLinkaByIdRequest $request)
    {
        $guest = Apiato::call('Guest@FindGuestByIdAction', [$request]);

        return $this->transform($guest, LinkaTransformer::class,['articles','answers','topics']);
    }

    /**
     * @param GuestLikeLinkaRequest $request
     * @return $boolen
     */
    public function guestLikeLinka(GuestLikeLinkaRequest $request)
    {
        $guest = Apiato::call('Guest@GuestLikeLinkaAction', [$request]);

        return $this->created($this->transform($guest, GuestTransformer::class), 200);
    }

    /**
     * @param ToBeLinkaRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function toBeLinka(ToBeLinkaRequest $request)
    {
        $linka = Apiato::call('Guest@ToBeLinkaAction', [$request]);

        return $this->created($this->transform($linka, AdminLinkaTransformer::class, ['navs']), 200);
    }

    /**
     * @param UploadImageRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadImage(UploadImageRequest $request)
    {
        $img_url = Apiato::call('Guest@UploadImageAction', [$request]);

        return $this->accepted($img_url, 200);
    }

    /**
     *
     * @return array
     */
    public function getLinkaProfile()
    {

        $guest = Apiato::call('Guest@FindGuestByIdTask', [auth_user()->id]);

        return $this->transform($guest, AdminLinkaTransformer::class, ['topics', 'articles']);
    }


    /**
     * @param GetSmsCodeRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSmsCode(GetSmsCodeRequest $request)
    {

        $code = Apiato::call('Guest@GetSmsCodeAction', [$request]);

        return $this->accepted($code, 200);
    }

    /**
     * @param CheckSmsCodeRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkSmsCode(CheckSmsCodeRequest $request)
    {

        $msg = Apiato::call('Guest@CheckSmsCodeAction', [$request]);

        return $this->accepted($msg, 200);
    }


    /**
     * @param GetGuestLikeLinkasRequest
     * @return array
     */
    public function getGuestLikeLinkas(GetGuestLikeLinkasRequest $request)
    {
        $linkas = Apiato::call('Guest@GetGuestLikeLinkasAction');

        return $this->transform($linkas, LinkaTransformer::class);
    }

    /**
     * @param GetGuestViewedLinkasRequest
     * @return array
     */
    public function getGuestViewedLinkas(GetGuestViewedLinkasRequest $request)
    {
        $linkas = Apiato::call('Guest@GetGuestViewedLinkasAction');

        return $this->transform($linkas, LinkaTransformer::class);
    }

    /**
     * @param UpdateGuestRequest $request
     * @return array
     */
    public function updateGuest(UpdateGuestRequest $request)
    {
        $guest = Apiato::call('Guest@UpdateGuestAction', [$request]);

        return $this->transform($guest, AdminLinkaTransformer::class);
    }



}
