<?php

namespace App\Containers\Authorization\UI\API\Requests;

use App\Ship\Parents\Requests\Request;

/**
 * Class UpdateMenuRequest.
 */
class SyncRoleMenusRequest extends Request
{
    /**
     * Define which Roles and/or Permissions has access to this request.
     *
     * @var  array
     */
    protected $access = [
        'permissions' => 'manage-roles',
        'roles'       => '',
    ];

    /**
     * Id's that needs decoding before applying the validation rules.
     *
     * @var  array
     */
    protected $decode = [
//         'role_id',
    ];

    /**
     * Defining the URL parameters (e.g, `/user/{id}`) allows applying
     * validation rules on them and allows accessing them like request data.
     *
     * @var  array
     */
    protected $urlParameters = [
//         'role_id',
    ];

    /**
     * @return  array
     */
    public function rules()
    {
        return [
            'role_id'  => 'required|exists:roles,id',
            'menu_ids' => 'required|array',

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
