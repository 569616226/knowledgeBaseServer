<?php

namespace App\Containers\Nav\UI\API\Tests\Functional\Mobile;


use App\Containers\Tests\TestCase;

/**
 * Class FindNavsTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class FindNavTopicsTest extends TestCase
{

    protected $endpoint = 'get@v1/navs/{id}/topics';

    protected $access = [
        'roles'       => '',
        'permissions' => '',
    ];

    /*默认*/
    public function testFindNavTopic_()
    {

        $this->getTestingGuestWithoutAccess();
        // send the HTTP request
        $response = $this->injectId($this->nav->id)->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertCount(3, $responseContent->data);

        $this->assertEquals( $this->topic_2->id, $responseContent->data[0]->real_id);
    }

    /*线下约见*/
    public function testFindNavTopicWithSerType0_()
    {

        $this->getTestingGuestWithoutAccess();
        // send the HTTP request
        $response = $this->injectId($this->nav->id)->endpoint($this->endpoint.'?ser_type=0')->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertCount(1, $responseContent->data);

        $this->assertEquals( $this->topic->id, $responseContent->data[0]->real_id);
    }

    /*全国通话*/
    public function testFindNavTopicWithSerType1_()
    {

        $this->getTestingGuestWithoutAccess();
        // send the HTTP request
        $response = $this->injectId($this->nav->id)->endpoint($this->endpoint.'?ser_type=1')->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertCount(2, $responseContent->data);

        $this->assertEquals( $this->topic_2->id, $responseContent->data[0]->real_id);
    }


    /*人气最高*/
    public function testFindNavTopicWithOrderBy1_()
    {

        $this->getTestingGuestWithoutAccess();
        // send the HTTP request
        $response = $this->injectId($this->nav->id)->endpoint($this->endpoint.'?order_by=1')->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertCount(3, $responseContent->data);


        $this->assertEquals( $this->topic_3->id, $responseContent->data[0]->real_id);
    }


    /*预约最新*/
    public function testFindNavTopicWithOrderBy2_()
    {

        $this->getTestingGuestWithoutAccess();
        // send the HTTP request
        $response = $this->injectId($this->nav->id)->endpoint($this->endpoint.'?order_by=2')->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertCount(3, $responseContent->data);

        $this->assertEquals( $this->topic->id, $responseContent->data[0]->real_id);
    }


    /*价格最低*/
    public function testFindNavTopicWithOrderBy3_()
    {

        $this->getTestingGuestWithoutAccess();
        // send the HTTP request
        $response = $this->injectId($this->nav->id)->endpoint($this->endpoint.'?order_by=3')->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertCount(3, $responseContent->data);

        $this->assertEquals( $this->topic_3->id, $responseContent->data[0]->real_id);
    }

}
