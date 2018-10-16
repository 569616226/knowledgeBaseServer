<?php

namespace App\Containers\Advert\UI\API\Requests;

use App\Ship\Parents\Requests\Request;

/**
 * Class CreateAdvertRequest.
 */
class CreateAdvertRequest extends Request
{
    /**
     * Define which Roles and/or Permissions has access to this request.
     *
     * @var  array
     */
    protected $access = [
        'permissions' => 'manage-adverts',
        'roles'       => '',
    ];

    /**
     * Id's that needs decoding before applying the validation rules.
     *
     * @var  array
     */
    protected $decode = [
        //'id',
    ];

    /**
     * Defining the URL parameters (e.g, `/user/{id}`) allows applying
     * validation rules on them and allows accessing them like request data.
     *
     * @var  array
     */
    protected $urlParameters = [
        //'id',
    ];

    /**
     * @return  array
     */
    public function rules()
    {
        return [
            'name'  => 'required|max:255',
            'path'  => 'required|max:255',
            'type'  => 'required|max:255',
            'order' => 'required|max:255',
            'url'   => 'required|max:255'
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
