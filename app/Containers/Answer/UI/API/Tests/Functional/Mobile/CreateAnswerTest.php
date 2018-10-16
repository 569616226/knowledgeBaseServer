<?php

namespace App\Containers\Answer\UI\API\Tests\Functional\Mobile;

use App\Containers\Tests\TestCase;

/**
 * Class CreateAdminTest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class CreateAnswerTest extends TestCase
{

    protected $endpoint = 'post@v1/answers';
    protected $access = [
        'permissions' => null,
        'roles'       => null,
    ];

    public function testCreateAnswer_()
    {
        $this->getTestingGuestWithoutAccess();

        $price = get_create_answer_price();

        $data = [
            'name'     => '问题标题',
            'linka_id' => $this->linka_1->id,
        ];

        // send the HTTP request
        $response = $this->endpoint($this->endpoint . '?include=question')->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);


        // assert the data is stored in the database
        $this->assertDatabaseHas('answers', [
            'name'  => $data['name'],
            'price' => $price,
        ]);

        $this->assertResponseContainKeys([
            'answer_id',
            'appId',
            'nonceStr',
            'package',
            'signType',
            'paySign',
            'timestamp',
        ]);

    }

}
