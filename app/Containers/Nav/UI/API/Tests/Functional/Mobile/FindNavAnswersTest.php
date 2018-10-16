<?php

namespace App\Containers\Nav\UI\API\Tests\Functional\Mobile;

use App\Containers\Tests\TestCase;

/**
 * Class FindNavsTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class FindNavAnswersTest extends TestCase
{

    protected $endpoint = 'get@v1/navs/{id}/answers';

    protected $access = [
        'roles'       => '',
        'permissions' => '',
    ];

    /*默认*/
    public function testFindNavAnswers_()
    {

        $this->getTestingGuestWithoutAccess();
        // send the HTTP request
        $response = $this->injectId($this->nav->id)->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertCount(4, $responseContent->data);
        $this->assertEquals( $this->answer_3->id, $responseContent->data[0]->real_id);
    }

    /*人气最高*/
    public function testFindNavAnswersWithOrderBy1_()
    {

        $this->getTestingGuestWithoutAccess();
        // send the HTTP request
        $response = $this->injectId($this->nav->id)->endpoint($this->endpoint.'?order_by=1')->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();


        $this->assertEquals( $this->answer_2->id, $responseContent->data[0]->real_id);
    }


    /*评分最高*/
    public function testFindNavAnswersWithOrderBy2_()
    {

        $this->getTestingGuestWithoutAccess();
        // send the HTTP request
        $response = $this->injectId($this->nav->id)->endpoint($this->endpoint.'?order_by=2')->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertEquals( $this->answer_3->id, $responseContent->data[0]->real_id);
    }



}
