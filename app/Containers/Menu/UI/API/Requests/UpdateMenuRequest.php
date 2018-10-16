<?php

namespace App\Containers\Menu\UI\API\Requests;

use App\Ship\Parents\Requests\Request;

/**
 * Class UpdateMenuRequest.
 */
class UpdateMenuRequest extends Request
{
    /**
     * Define which Roles and/or Permissions has access to this request.
     *
     * @var  array
     */
    protected $access = [
        'permissions' => 'manage-menus',
        'roles'       => '',
    ];

    /**
     * Id's that needs decoding before applying the validation rules.
     *
     * @var  array
     */
    protected $decode = [
        'id',
    ];

    /**
     * Defining the URL parameters (e.g, `/user/{id}`) allows applying
     * validation rules on them and allows accessing them like request data.
     *
     * @var  array
     */
    protected $urlParameters = [
        'id',
    ];

    /**
     * @return  array
     */
    public function rules()
    {
        return [
            'id'          => 'required|exists:menus,id',
            'name'        => 'required|max:255',
            'parent_id'   => 'required|numeric',
            'icon'        => 'required|max:255',
            'url'         => 'required|max:255',
            'description' => 'max:255',
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
