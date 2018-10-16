<?php

namespace App\Containers\Article\UI\API\Tests\Functional\Mobile;

use App\Containers\Tests\TestCase;

/**
 * Class CreateAdminTest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class CreateArticleTest extends TestCase
{

    protected $endpoint = 'post@v1/articles';

    protected $access = [
        'permissions' => null,
        'roles'       => null,
    ];

    public function testCreateArticle_()
    {
        $guest = $this->getTestingGuestWithoutAccess();
        $data = [
            'title'   => $this->faker->title,
            'content' => $this->faker->paragraph,
            'cover'   => $this->faker->imageUrl(),
        ];

        // send the HTTP request
        $response = $this->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        $this->assertResponseContainKeyValue([
            'title'        => $data['title'],
            'content'      => $data['content'],
            'cover'        => $data['cover'],
            'readers'      => 0,
            'guest_name'   => $guest->real_name,
            'guest_cover'  => $guest->cover,
            'guest_office' => $guest->office,
        ]);

        // assert response contain the token
        $this->assertResponseContainKeys(['id']);

        // assert the data is stored in the database
        $this->assertDatabaseHas('articles', [
            'title'    => $data['title'],
            'content'  => $data['content'],
            'cover'    => $data['cover'],
            'guest_id' => $guest->id,
        ]);

    }

}
