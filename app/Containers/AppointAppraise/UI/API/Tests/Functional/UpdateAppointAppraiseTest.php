<?php

namespace App\Containers\AppointAppraise\UI\API\Tests\Functional;


use App\Containers\Tests\TestCase;

/**
 * Class UpdateAppointAppraiseTest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class UpdateAppointAppraiseAppraiseTest extends TestCase
{

    protected $endpoint = 'patch@v1/appoint_appraises/{id}';
    protected $access = [
        'permissions' => null,
        'roles'       => null,
    ];

    public function testUpdateExistingAppointAppraise_()
    {

        $this->getTestingGuestWithoutAccess();

        $data = [
            'star'    => 4,
            'degree'  => 3,
            'content' => '老师很nice，对提出的总是回答的都很详细。很专业，很有针对性。',
        ];

        // send the HTTP request
        $response = $this->injectId($this->appoint_appraise->id)->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        // assert returned appoint_appraise is the updated one
        $this->assertResponseContainKeyValue([
            'object'  => 'AppointAppraise',
            'star'    => $data['star'],
            'degree'  => $data['degree'],
            'content' => $data['content'],
        ]);

        // assert data was updated in the database
        $this->assertDatabaseHas('appoint_appraises', [
            'star'    => $data['star'],
            'degree'  => $data['degree'],
            'content' => $data['content'],
        ]);
    }

    public function testUpdateNonExistingAppointAppraise_()
    {
        $data = [
            'star' => 2,
        ];
        $this->getTestingGuestWithoutAccess();

        $fakeAppointAppraiseId = 7777;

        // send the HTTP request
        $response = $this->injectId($fakeAppointAppraiseId)->makeCall($data);

        // assert response status is correct
        $response->assertStatus(422);

        $this->assertResponseContainKeyValue([
            'status' => 'error'
        ]);
    }

    public function testUpdateExistingAppointAppraiseWithoutData_()
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
