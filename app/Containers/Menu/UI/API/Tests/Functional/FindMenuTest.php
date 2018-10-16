<?php

namespace App\Containers\Menu\UI\API\Tests\Functional;

use App\Containers\Menu\Models\Menu;
use App\Containers\Tests\TestCase;

/**
 * Class FindMenussTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class FindMenuTest extends TestCase
{

    protected $endpoint = 'get@v1/menus/{id}';

    protected $access = [
        'roles'       => '',
        'permissions' => 'manage-menus',
    ];

    public function testFindMenus_()
    {
       factory(Menu::class)->create(['parent_id' => $this->menu->id]);
        // send the HTTP request
        $response = $this->injectId($this->menu->id)->makeCall();


        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $children_menus = Menu::where('parent_id',$this->menu->id)->get()->count();

        $this->assertEquals($this->menu->name, $responseContent->data->name);
        $this->assertEquals($this->menu->parent_id, $responseContent->data->parent_id);
        $this->assertEquals($this->menu->url, $responseContent->data->url);
        $this->assertCount($children_menus, $responseContent->data->children);
    }

}
