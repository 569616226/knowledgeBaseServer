<?php

namespace App\Containers\Topic\UI\API\Requests;

use App\Ship\Parents\Requests\Request;

/**
 * Class CreateTopicRequest.
 */
class CreateTopicRequest extends Request
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
        // 'id',
    ];

    /**
     * Defining the URL parameters (e.g, `/user/{id}`) allows applying
     * validation rules on them and allows accessing them like request data.
     *
     * @var  array
     */
    protected $urlParameters = [
        // 'id',
    ];

    /**
     * @return  array
     */
    public function rules()
    {
        return [
            'title'      => 'required|max:255',
            'describe'   => 'required',
            'price'      => 'required|numeric',
            'ser_type'   => 'required|numeric',
            'ser_time'   => 'required|numeric',
            'need_infos' => 'required|array',
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
