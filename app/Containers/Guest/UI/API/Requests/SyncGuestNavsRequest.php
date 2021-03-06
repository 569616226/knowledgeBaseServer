<?php

namespace App\Containers\Guest\UI\API\Requests;

use App\Ship\Parents\Requests\Request;

/**
 * Class SyncGuestGroupsRequest.
 */
class SyncGuestNavsRequest extends Request
{
    /**
     * Define which Roles and/or Permissions has access to this request.
     *
     * @var  array
     */
    protected $access = [
        'permissions' => 'manage-guests',
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
            'guest_id' => 'required|exists:guests,id',
            'navs_ids' => 'required|array',
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
