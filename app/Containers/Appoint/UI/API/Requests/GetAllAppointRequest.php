<?php

namespace App\Containers\Appoint\UI\API\Requests;

use App\Ship\Parents\Requests\Request;

/**
 * Class UpdateAppointRequest.
 */
class GetAllAppointRequest extends Request
{
    /**
     * Define which Roles and/or Permissions has access to this request.
     *
     * @var  array
     */
    protected $access = [
        'permissions' => 'manage-appoints',
        'roles'       => '',
    ];

    /**
     * Define which Roles and/or Permissions has access to this request.
     *
     * @var  array
     */

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
//             'id' => 'required|exists:appoints,id',
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
