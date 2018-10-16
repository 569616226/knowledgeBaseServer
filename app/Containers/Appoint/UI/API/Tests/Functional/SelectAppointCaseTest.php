<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/28
 * Time: 13:53
 */

namespace App\Containers\Appoint\UI\API\Tests\Functional;

use App\Containers\Appoint\Models\Appoint;
use App\Containers\AppointCase\Models\AppointCase;
use App\Containers\Tests\TestCase;

class SelectAppointCaseTest extends TestCase
{
    protected $endpoint = 'post@v1/appoints/{id}/select_appoint_case';
    protected $access = [
        'permissions' => null,
        'roles'       => null,
    ];

    public function testChangeAppointStatusTo1_()
    {
        $guest = $this->getTestingGuestWithoutAccess();
        $appoint = factory(Appoint::class)->create([
            'status'   => 3,
            'guest_id' => $guest->id,
        ]);

        $appoint_case = factory(AppointCase::class)->create([
            'guest_id'   => $guest->id,
            'appoint_id' => $appoint->id,
        ]);

        $data = [
            'case_id' => $appoint_case->id,
        ];

        // send the HTTP request
        $response = $this->injectId($appoint->id)->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        // convert JSON response string to Object
        $responseContent = $this->getResponseContentObject();

        $this->assertEquals($appoint_case->id, $responseContent->data->case_id);

    }

}