<?php

namespace App\Containers\Answer\UI\API\Tests\Functional\Mobile;

use App\Containers\Tests\TestCase;


/**
 * Class FindUsersTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class GetGuestReadAnswersTest extends TestCase
{

    protected $endpoint = 'get@v1/guest_read_answers/';
    protected $access = [
        'permissions' => null,
        'roles'       => null,
    ];

    public function testGetGuestReadAnswer_()
    {
        $guest = $this->getTestingGuestWithoutAccess();
        $guest->my_answers()->attach([$this->answer->id => ['is_reader' => 1]]);
        // send the HTTP request
        $response = $this->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        // convert JSON response string to Object
        $responseContent = $this->getResponseContentObject();

        $guest_read_answer_counts = $guest->read_answers->count();
        // assert the returned data size is correct
        $this->assertCount($guest_read_answer_counts, $responseContent->data); // 2 (fake in this test) + 1 (that is logged in) + 1 (seeded super admin)
    }


}
