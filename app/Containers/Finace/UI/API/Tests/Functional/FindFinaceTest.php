<?php

namespace App\Containers\Finace\UI\API\Tests\Functional;


use App\Containers\Finace\Models\Finace;
use App\Containers\Tests\TestCase;

/**
 * Class FindFinacessTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class FindFinaceTest extends TestCase
{

    protected $endpoint = 'get@v1/finaces/{id}';
    protected $access = [
        'roles'       => '',
        'permissions' => 'manage-finaces',
    ];

    public function testFindFinaces0_()
    {

        $finace = factory(Finace::class)->create([
            'order_name' => '回答问题收入',
            'guest_id'   => $this->guest->id,
            'order_no'   => create_order_number(),
            'price'      => $this->faker->numberBetween(100, 200),
            'type'       => 0,
        ]);
        // send the HTTP request
        $response = $this->injectId($finace->id)->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertEquals($finace->name, $responseContent->data->name);
        $this->assertEquals($finace->order_no, $responseContent->data->order_no);
        $this->assertEquals($finace->order_name, $responseContent->data->order_name);
        $this->assertEquals($finace->price, $responseContent->data->price);
        $this->assertEquals($finace->guest->name, $responseContent->data->guest_name);
        $this->assertEquals('收入', $responseContent->data->finace_type);
    }

    public function testFindFinaces1_()
    {

        $finace = factory(Finace::class)->create([
            'order_name' => '约见学员收入',
            'guest_id'   => $this->guest->id,
            'order_no'   => create_order_number(),
            'price'      => $this->faker->numberBetween(100, 200),
            'type'       => 1,
        ]);
        // send the HTTP request
        $response = $this->injectId($finace->id)->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();
        $this->assertEquals($finace->name, $responseContent->data->name);
        $this->assertEquals($finace->order_no, $responseContent->data->order_no);
        $this->assertEquals($finace->order_name, $responseContent->data->order_name);
        $this->assertEquals($finace->price, $responseContent->data->price);
        $this->assertEquals($finace->guest->name, $responseContent->data->guest_name);
        $this->assertEquals('收入', $responseContent->data->finace_type);
    }

    public function testFindFinaces2_()
    {

        $finace = factory(Finace::class)->create([
            'order_name' => '约见大咖收入',
            'guest_id'   => $this->guest->id,
            'order_no'   => create_order_number(),
            'price'      => $this->faker->numberBetween(100, 200),
            'type'       => 2,
        ]);
        // send the HTTP request
        $response = $this->injectId($finace->id)->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertEquals($finace->name, $responseContent->data->name);
        $this->assertEquals($finace->order_no, $responseContent->data->order_no);
        $this->assertEquals($finace->order_name, $responseContent->data->order_name);
        $this->assertEquals($finace->price, $responseContent->data->price);
        $this->assertEquals($finace->guest->name, $responseContent->data->guest_name);
        $this->assertEquals('收入', $responseContent->data->finace_type);
    }


    public function testFindFinaces3_()
    {

        $finace = factory(Finace::class)->create([
            'order_name' => '问答被查看收入',
            'guest_id'   => $this->guest->id,
            'order_no'   => create_order_number(),
            'price'      => $this->faker->numberBetween(100, 200),
            'type'       => 3,
        ]);
        // send the HTTP request
        $response = $this->injectId($finace->id)->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertEquals($finace->name, $responseContent->data->name);
        $this->assertEquals($finace->order_no, $responseContent->data->order_no);
        $this->assertEquals($finace->order_name, $responseContent->data->order_name);
        $this->assertEquals($finace->price, $responseContent->data->price);
        $this->assertEquals($finace->guest->name, $responseContent->data->guest_name);
        $this->assertEquals('收入', $responseContent->data->finace_type);
    }


    public function testFindFinaces4_()
    {

        $finace = factory(Finace::class)->create([
            'order_name' => '收到违约金',
            'guest_id'   => $this->guest->id,
            'order_no'   => create_order_number(),
            'price'      => $this->faker->numberBetween(100, 200),
            'type'       => 4,
        ]);
        // send the HTTP request
        $response = $this->injectId($finace->id)->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertEquals($finace->name, $responseContent->data->name);
        $this->assertEquals($finace->order_no, $responseContent->data->order_no);
        $this->assertEquals($finace->order_name, $responseContent->data->order_name);
        $this->assertEquals($finace->price, $responseContent->data->price);
        $this->assertEquals($finace->guest->name, $responseContent->data->guest_name);
        $this->assertEquals('收入', $responseContent->data->finace_type);
    }

    public function testFindFinaces5_()
    {

        $finace = factory(Finace::class)->create([
            'order_name' => '提现金额',
            'guest_id'   => $this->guest->id,
            'order_no'   => create_order_number(),
            'price'      => $this->faker->numberBetween(100, 200),
            'type'       => 5,
        ]);
        // send the HTTP request
        $response = $this->injectId($finace->id)->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertEquals($finace->name, $responseContent->data->name);
        $this->assertEquals($finace->order_no, $responseContent->data->order_no);
        $this->assertEquals($finace->order_name, $responseContent->data->order_name);
        $this->assertEquals($finace->price, $responseContent->data->price);
        $this->assertEquals($finace->guest->name, $responseContent->data->guest_name);
        $this->assertEquals('支出', $responseContent->data->finace_type);
    }


}
