<?php

namespace App\Containers\Topic\UI\API\Tests\Functional;

use App\Containers\Tests\TestCase;

/**
 * Class UpdateTopicTest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class UpdateTopicTest extends TestCase
{

    protected $endpoint = 'post@v1/topics/{id}';
    protected $access = [
        'permissions' => null,
        'roles'       => null,
    ];

    public function testUpdateExistingTopic_()
    {

        $this->getTestingGuestWithoutAccess();

        $data = [
            'title'      => '话题名字更新',
            'describe'   => '问题内容更新',
            'price'      => 300,
            'ser_type'   => 1,
            'ser_time'   => 2,
            'need_infos' => [0, 1],
            'remark'     => 'remark',
        ];

        // send the HTTP request
        $response = $this->injectId($this->topic->id)->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        // assert returned topic is the updated one
        $this->assertResponseContainKeyValue([
            'object'     => 'Topic',
            'title'      => $data['title'],
            'describe'   => $data['describe'],
            'ser_type'   => $this->ser_type[$data['ser_type']],
            'ser_time'   => $data['ser_time'],
            'price'      => $data['price'],
            'need_infos' => $data['need_infos'],
            'remark'     => $data['remark'],

        ]);

        // assert data was updated in the database
        $this->assertDatabaseHas('topics', [
            'title'      => $data['title'],
            'describe'   => $data['describe'],
            'ser_type'   => $data['ser_type'],
            'ser_time'   => $data['ser_time'],
            'price'      => $data['price'],
            'need_infos' => '[0,1]',
            'remark'     => $data['remark'],
        ]);
    }

    public function testUpdateNonExistingTopic_()
    {
        $data = [
            'title' => '英小俊_test',
        ];
        $this->getTestingGuestWithoutAccess();

        $fakeTopicId = 7777;

        // send the HTTP request
        $response = $this->injectId($fakeTopicId)->makeCall($data);

        // assert response status is correct
        $response->assertStatus(422);

        $this->assertResponseContainKeyValue([
            'status' => 'error'
        ]);
    }

    public function testUpdateExistingTopicWithoutData_()
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

    public function testUpdateExistingTopicWithEmptyValues()
    {
        $data = [
            'title' => '',
        ];
        $this->getTestingGuestWithoutAccess();

        // send the HTTP request
        $response = $this->injectId($this->topic->id)->makeCall($data);

        // assert response status is correct
        $response->assertStatus(422);

        $this->assertValidationErrorContain([
            // messages should be updated after modifying the validation rules, to pass this test
            'title' => 'title 值不能为空',
        ]);

    }
}
