<?php

namespace App\Containers\Settings\UI\API\Requests;

use App\Ship\Parents\Requests\Request;

/**
 * Class GetAllSettingsRequest.
 */
class FindSettingByKeyRequest extends Request
{
    /**
     * Define which Roles and/or Permissions has access to this request.
     *
     * @var  array
     */
    protected $access = [
        'permissions' => 'manage-settings',
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
            'key' => 'sometimes|string|max:190',
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
