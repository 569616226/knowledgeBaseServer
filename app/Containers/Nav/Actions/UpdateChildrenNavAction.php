<?php

namespace App\Containers\Nav\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Exceptions\Exception;
use App\Ship\Parents\Requests\Request;

class UpdateChildrenNavAction extends Action
{
    public function run(Request $request)
    {
        $nav_children = $request->nav_children;

        return  \DB::transaction(function () use($nav_children,$request) {
            try {

                foreach ($nav_children as $nav_child) {

                    if ($nav_child['del']) {

                        Apiato::call('Nav@DeleteNavTask', [$nav_child['id']]);

                    } elseif ($nav_child['id']) {

                        Apiato::call('Nav@UpdateNavTask', [$nav_child['id'], ['name' => $nav_child]['name']]);

                    } else {

                        $data = [
                            'pid'       =>  $request->id,
                            'user_id'   => $request->user()->id,
                            'name'      => $nav_child['name']
                        ];

                        Apiato::call('Nav@CreateNavTask', [$data]);
                    }
                }

                return true;

            } catch (Exception $exception) {
                report($exception);
                throw new UpdateResourceFailedException();

            }
        });

    }
}
