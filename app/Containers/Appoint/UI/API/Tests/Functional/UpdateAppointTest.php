<?php

namespace App\Containers\Appoint\UI\API\Tests\Functional;


use App\Containers\Tests\TestCase;

/**
 * Class UpdateAppointTest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class UpdateAppointTest extends TestCase
{

    protected $endpoint = 'patch@v1/appoints/{id}';
    protected $access = [
        'permissions' => null,
        'roles'       => null,
    ];

    public function testUpdateExistingAppoint_()
    {

        $this->getTestingGuestWithoutAccess();

        $data = [
            'cancel_res' => '取消原因',
            'canceler'   => '取消人',
            'answers'    => [0, 1, 2],
            'profile'    => '个人介绍',
        ];

        // send the HTTP request
        $response = $this->injectId($this->appoint->id)->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        // assert returned appoint is the updated one
        $this->assertResponseContainKeyValue([
            'object'     => 'Appoint',
            'cancel_res' => $data['cancel_res'],
            'canceler'   => $data['canceler'],
            'answers'    => $data['answers'],
            'profile'    => $data['profile'],
        ]);

        // assert data was updated in the database
        $this->assertDatabaseHas('appoints', [
            'cancel_res' => $data['cancel_res'],
            'canceler'   => $data['canceler'],
            'answers'    => "[0,1,2]",
            'profile'    => $data['profile'],
        ]);
    }

    public function testUpdateNonExistingAppoint_()
    {
        $data = [
            'cancel_res' => '英小俊_test',
        ];
        $this->getTestingGuestWithoutAccess();

        $fakeAppointId = 7777;

        // send the HTTP request
        $response = $this->injectId($fakeAppointId)->makeCall($data);

        // assert response status is correct
        $response->assertStatus(422);

        $this->assertResponseContainKeyValue([
            'status' => 'error'
        ]);
    }

    public function testUpdateExistingAppointWithoutData_()
    {
        $this->getTestingGuestWithoutAccess();
        // send the HTTP request
        $response = $this->makeCall();

        // assert response status is correct
        $response->assertStatus(422);

        $this->assertResponseContainKeyValue([
            'message' => 'The given data was invalid.'
        ]);
    }

}
