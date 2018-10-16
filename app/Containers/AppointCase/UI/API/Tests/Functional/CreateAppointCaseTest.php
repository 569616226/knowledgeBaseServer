<?php

namespace App\Containers\AppointCase\UI\API\Tests\Functional;

use App\Containers\AppointCase\Models\AppointCase;
use App\Containers\Tests\TestCase;

/**
 * Class CreateAdminTest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class CreateAppointCaseTest extends TestCase
{

    protected $endpoint = 'post@v1/appoint_cases';
    protected $access = [
        'permissions' => null,
        'roles'       => null,
    ];

    public function testCreateAppointCase_()
    {
        $guest = $this->getTestingGuestWithoutAccess();

        $data = [

            'appoint_cases' => [
                [
                    'appoint_time' => now()->format('Y-m-d H:i'),
                    'location'     => 'location_1',
                    'appoint_id'   => $this->appoint->id,
                ], [
                    'id'           => $this->appoint_case->id,
                    'appoint_time' => now()->format('Y-m-d H:i'),
                    'location'     => 'location_2',
                ], [
                    'is_del'       => true,
                    'id'           => $this->appoint_case_2->id,
                    'appoint_time' => now()->format('Y-m-d H:i'),
                    'location'     => 'location_2',
                ],

            ]

        ];

        // send the HTTP request
        $response = $this->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        $this->assertResponseContainKeyValue([
            'status'  => true,
            'msg'  => '操作成功',
        ]);

        // assert the data is stored in the database
        $this->assertDatabaseHas('appoint_cases', [
            'guest_id'   => $guest->id,
            'appoint_id' => $this->appoint->id,
            'location'   => 'location_2',
        ]);

        $this->assertDatabaseHas('appoint_cases', [
            'guest_id'   => $guest->id,
            'appoint_id' => $this->appoint->id,
            'location'   => 'location_1',
        ]);

        $del_appoint_cases_id = AppointCase::onlyTrashed()->get()->pluck('id')->toArray();

        $this->assertTrue(in_array($this->appoint_case_2->id,$del_appoint_cases_id));

    }

}
