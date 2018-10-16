<?php

namespace App\Containers\Order\UI\API\Requests;

use App\Ship\Parents\Requests\Request;

/**
 * Class ChangeOrderStatusRequest.
 */
class ChangeOrderAuditStatusRequest extends Request
{
    /**
     * Define which Roles and/or Permissions has access to this request.
     *
     * @var  array
     */
    protected $access = [
        'permissions' => 'manage-finace_aduit',
        'roles'       => 'finace',
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
            'id'                  => 'required|exists:orders,id',
            'refund_audit_status' => 'required|numeric',
            'refund_audit_remark' => 'required|max:255',
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
