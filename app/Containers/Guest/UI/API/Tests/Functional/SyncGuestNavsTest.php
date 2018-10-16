<?php

namespace App\Containers\Guest\UI\API\Tests\Functional;

use App\Containers\Nav\Models\Nav;
use App\Containers\Tests\TestCase;

/**
 * Class SyncGuestNavsTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class SyncGuestNavsTest extends TestCase
{

    protected $endpoint = 'post@v1/navs/sync';

    protected $access = [
        'navs'        => '',
        'permissions' => 'manage-guests',
    ];

    public function testSyncMultipleNavsOnGuest()
    {
        $nav1 = factory(Nav::class)->create();
        $nav2 = factory(Nav::class)->create();

        $this->guest->navs()->sync($nav1);


        $data = [
            'navs_ids' => [
                $nav1->id,
                $nav2->id,
            ],

            'guest_id' => $this->guest->id,
        ];

        // send the HTTP request
        $response = $this->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertTrue(count($responseContent->data->navs->data) > 1);

        $navIds = array_pluck($responseContent->data->navs->data, 'id');

        $this->assertContains($nav1->getHashedKey(), $navIds);
        $this->assertContains($nav2->getHashedKey(), $navIds);

    }

}
