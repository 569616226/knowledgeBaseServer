<?php

namespace App\Containers\Wechat\UI\API\Requests;

use App\Ship\Parents\Requests\Request;

/**
 * Class FindTopicByIdRequest.
 */
class SendEmailRequest extends Request
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

    ];

    /**
     * Defining the URL parameters (e.g, `/user/{id}`) allows applying
     * validation rules on them and allows accessing them like request data.
     *
     * @var  array
     */
    protected $urlParameters = [

    ];

    /**
     * @return  array
     */
    public function rules()
    {
        return [
            'content' => 'required',
        ];
    }

    /**
     * @return  bool
     */
    public function authorize()
    {
        return  $this->check(['hasAccess']);
    }
}
