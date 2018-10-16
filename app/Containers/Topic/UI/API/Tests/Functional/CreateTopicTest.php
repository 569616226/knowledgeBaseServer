<?php

namespace App\Containers\Topic\UI\API\Tests\Functional;

use App\Containers\Tests\TestCase;

/**
 * Class CreateAdminTest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class CreateTopicTest extends TestCase
{

    protected $endpoint = 'post@v1/topics';

    protected $access = [
        'permissions' => null,
        'roles'       => null,
    ];

    public function testCreateTopic_()
    {
        $guest = $this->getTestingGuestWithoutAccess();

        $data = [
            'title'      => '话题名字',
            'describe'   => '问题内容',
            'price'      => 200,
            'ser_type'   => 0,
            'ser_time'   => 1,
            'need_infos' => [1, 2, 3],
        ];

        // send the HTTP request
        $response = $this->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        $this->assertResponseContainKeyValue([
            'object'     => 'Topic',
            'title'      => $data['title'],
            'status'     => '待审核',
            'describe'   => $data['describe'],
            'ser_type'   => $this->ser_type[$data['ser_type']],
            'ser_time'   => 1,
            'price'      => $data['price'],
            'guest_name' => $guest->real_name,
            'guest_avatar' => $guest->avatar,
            'guest_office' => $guest->office,
            'need_infos' => [1, 2, 3],
            'remark'     => null,
        ]);

        // assert response contain the token
        $this->assertResponseContainKeys(['id']);

        // assert the data is stored in the database
        $this->assertDatabaseHas('topics', [
            'title'      => $data['title'],
            'status'     => 2,
            'describe'   => $data['describe'],
            'ser_type'   => 0,
            'ser_time'   => 1,
            'price'      => $data['price'],
            'guest_id'   => $guest->id,
            'need_infos' => "[1,2,3]",
            'remark'     => null,
        ]);
    }
}
