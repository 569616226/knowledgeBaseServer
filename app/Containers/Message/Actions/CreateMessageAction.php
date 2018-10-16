<?php

namespace App\Containers\Message\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Group\Models\Group;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class CreateMessageAction extends Action
{
    public function run(Request $request)
    {

        $group_id = $request->get('group_id');
        $group = Group::find($group_id);

        $data = [
            'title'      => $request->get('title'),
            'msg_type'   => $request->get('msg_type'),
            'group_name' => $group->name,
            'content'    => htmlspecialchars($request->get('content')),
            'sender'     => $request->user()->name,
            'img_url'    => $request->get('img_url'),
            'is_read'    => false,
        ];

        $message_data = ['data' => $data, 'group' => $group, 'url' => $request->url];

        $message = Apiato::call('Message@CreateMessageTask', [$message_data]);

        return $message;
    }
}
