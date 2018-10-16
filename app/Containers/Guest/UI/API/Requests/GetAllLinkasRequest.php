<?php

namespace App\Containers\Guest\UI\API\Requests;

use App\Ship\Parents\Requests\Request;

/**
 * Class UpdateGuestRequest.
 */
class GetAllLinkasRequest extends Request
{

    protected $access = [
        'roles'       => '',
        'permissions' => 'manage-linkas',
    ];

    /**
     * Id's that needs decoding before applying the validation rules.
     *
     * @var  array
     */
    protected $decode = [
//        'id',
    ];

    /**
     * Defining the URL parameters (e.g, `/user/{id}`) allows applying
     * validation rules on them and allows accessing them like request data.
     *
     * @var  array
     */
    protected $urlParameters = [
//        'id',
    ];

    /**
     * @return  array
     */
    public function rules()
    {
        return [

        ];
    }

    /**
     * @return  bool
     */
    public function authorize()
    {
        return $this->hasActionPermission();
    }
}
