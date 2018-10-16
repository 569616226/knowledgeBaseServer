<?php

namespace App\Containers\Order\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class ChangeOrderAuditStatusAction extends Action
{
    public function run(Request $request)
    {
        $data = [
            'refund_audit_status' => $request->refund_audit_status,
            'refund_audit_remark'=> $request->refund_audit_remark,
            'refund_auditor'    => $request->user()->name,
            'refund_audit_time' => now(),
            'status' => 3,
        ];

        $order = Apiato::call('Order@ChangeOrderAuditStatusTask', [$request->id, $data]);

        return $order;
    }
}
