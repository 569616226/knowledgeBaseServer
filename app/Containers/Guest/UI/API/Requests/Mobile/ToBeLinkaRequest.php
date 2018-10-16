<?php

namespace App\Containers\Guest\UI\API\Requests\Mobile;

use App\Ship\Parents\Requests\Request;

/**
 * Class CreateGuestRequest.
 */
class ToBeLinkaRequest extends Request
{
    /**
     * Define which Roles and/or Permissions has access to this request.
     *
     * @var  array
     */
    protected $access = [
        'permissions' => '',
        'roles'       => '',
    ];

    /**
     * Id's that needs decoding before applying the validation rules.
     *
     * @var  array
     */
    protected $decode = [
//         'id',
    ];

    /**
     * Defining the URL parameters (e.g, `/user/{id}`) allows applying
     * validation rules on them and allows accessing them like request data.
     *
     * @var  array
     */
    protected $urlParameters = [
//         'id',
    ];

    /**
     * @return  array
     */
    public function rules()
    {
        return [
            'real_name'      => 'required|max:255',
            'phone'          => 'required|integer',
            'city'           => 'required|max:255',
            'single_profile' => 'required',
            'office'         => 'required',
            'navs'           => 'required|array',
            'location'       => 'required',
            'card_id'        => 'required|integer',
            'card_pic'       => 'required',
        ];
    }

    /**
     * @return  bool
     */
    public function authorize()
    {
        return $this->check(['hasAccess',]);
    }
}
