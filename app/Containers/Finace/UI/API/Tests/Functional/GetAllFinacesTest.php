<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/28
 * Time: 16:59
 */

namespace App\Containers\Finace\UI\API\Tests\Functional;

use App\Containers\Finace\Models\Finace;
use App\Containers\Tests\TestCase;

class GetAllFinacesTest extends TestCase
{
    protected $endpoint = 'get@v1/finaces';

    protected $access = [
        'roles'       => 'finace',
        'permissions' => 'manage-finaces',
    ];

    public function testGetAllComplateFinaces_()
    {

       factory(Finace::class)->create([
            'order_name' => '回答问题收入',
            'guest_id'   => $this->guest->id,
            'order_no'   => create_order_number(),
            'price'      => $this->faker->numberBetween(100, 200),
            'type'       => 0,
        ]);

        // send the HTTP request
        $response = $this->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        // convert JSON response string to Object
        $responseContent = $this->getResponseContentObject();

        $finace_counts = Finace::all()->count();

        // assert the returned data size is correct
        $this->assertCount($finace_counts, $responseContent->data); // 2 (fake in this test) + 1 (that is logged in) + 1 (seeded super admin)
    }
}