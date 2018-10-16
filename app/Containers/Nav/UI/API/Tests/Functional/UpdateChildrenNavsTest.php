<?php

namespace App\Containers\Nav\UI\API\Tests\Functional;

use App\Containers\Nav\Models\Nav;
use App\Containers\Tests\TestCase;

/**
 * Class UpdateNavTest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class UpdateChildrenNavsTest extends TestCase
{

    protected $endpoint = 'patch@v1/navs/{id}/children';

    protected $access = [
        'roles'       => '',
        'permissions' => 'manage-navs',
    ];

    public function testUpdateChildrenNavSuccess_()
    {
        $nav = factory(Nav::class)->create(['pid' => $this->nav->id]);
        $nav_1 = factory(Nav::class)->create(['pid' => $this->nav->id]);

        $data = [
            'nav_children' => [
                ['name' => 'child1','id' => $nav->id,'del' => false],
                ['name' => 'child2','id' => null,'del' => false],
                ['id' => $nav_1->id,'del' => true],
            ]

        ];

        // send the HTTP request
        $response = $this->injectId($this->nav->id)->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        // assert the returned message is correct
        $this->assertResponseContainKeyValue([
            'status' => true,
            'msg'    => "操作成功",
        ]);

        // assert data was updated in the database
        $this->assertDatabaseHas('navs', ['name' => $data['nav_children'][0]['name']]);
        $this->assertDatabaseHas('navs', ['name' => $data['nav_children'][1]['name']]);

        $this->assertFalse(in_array($nav_1->id,$this->nav->children->pluck('id')->toArray()));
        $this->assertCount(2,$this->nav->children);
    }

    public function testUpdateChildrenNavFail_()
    {
        $nav = factory(Nav::class)->create(['pid' => $this->nav->id]);
        $nav_1 = factory(Nav::class)->create(['pid' => $this->nav->id]);

        $data = [
            'nav_children' => [
                ['name' => 'child1','id' => $nav->id,'del' => false],
                ['name' => 'child2','id' => null,'del' => false],
                ['id' => 2000,'del' => true],
            ]

        ];

        // send the HTTP request
        $response = $this->injectId($this->nav->id)->makeCall($data);

        // assert response status is correct
        $response->assertStatus(417);

    }

}
