<?php

namespace App\Containers\Guest\UI\API\Tests\Functional;

use App\Containers\Group\Models\Group;
use App\Containers\Tests\TestCase;

/**
 * Class SyncGuestGroupsTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class SyncGuestGroupsTest extends TestCase
{

    protected $endpoint = 'post@v1/groups/sync';

    protected $access = [
        'groups'      => '',
        'permissions' => 'manage-guests',
    ];

    public function testSyncMultipleGroupsOnGuest()
    {
        $group1 = factory(Group::class)->create();
        $group2 = factory(Group::class)->create();

        $this->guest->groups()->sync($group1);


        $data = [
            'groups_ids' => [
                $group1->id,
                $group2->id,
            ],

            'guest_id' => $this->guest->id,
        ];

        // send the HTTP request
        $response = $this->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertTrue(count($responseContent->data->groups->data) > 1);

        $groupIds = array_pluck($responseContent->data->groups->data, 'id');

        $this->assertContains($group1->getHashedKey(), $groupIds);
        $this->assertContains($group2->getHashedKey(), $groupIds);

    }

}
