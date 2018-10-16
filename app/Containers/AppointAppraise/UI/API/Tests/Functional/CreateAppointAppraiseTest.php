<?php

namespace App\Containers\AppointAppraise\UI\API\Tests\Functional;

use App\Containers\Tests\TestCase;


/**
 * Class CreateAdminTest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class CreateAppointAppraiseTest extends TestCase
{

    protected $endpoint = 'post@v1/appoint_appraises/{id}';
    protected $access = [
        'permissions' => null,
        'roles'       => null,
    ];

    public function testCreateAppointAppraise_()
    {

        $this->getTestingGuestWithoutAccess();

        $data = [
            'star'       => 4,
            'degree'     => 3,
            'content'    => '老师很nice，对提出的总是回答的都很详细。很专业，很有针对性。',
            'appoint_id' => $this->appoint->id,
        ];

        // send the HTTP request
        $response = $this->injectId($this->appoint->id)->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        $this->assertResponseContainKeyValue([
            'status'  => true,
            'msg'  => '操作成功',
        ]);

        // assert the data is stored in the database
        $this->assertDatabaseHas('appoint_appraises', [

            'appoint_id' => $this->appoint->id,
            'star'       => $data['star'],
            'degree'     => $data['degree'],
            'content'    => $data['content'],
        ]);

    }

}
