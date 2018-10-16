<?php

namespace App\Containers\Article\UI\API\Tests\Functional\Mobile;

use App\Containers\Tests\TestCase;

/**
 * Class UpdateArticleTest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class UpdateArticleTest extends TestCase
{

    protected $endpoint = 'patch@v1/articles/{id}';

    protected $access = [
        'roles'       => null,
        'permissions' => null,
    ];

    public function testUpdateExistingArticle_()
    {
        $this->getTestingGuestWithoutAccess();

        $data = [
            'title'   => $this->faker->title,
            'content' => $this->faker->paragraph,
            'cover'   => $this->faker->imageUrl(),
        ];

        // send the HTTP request
        $response = $this->injectId($this->article->id)->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        // assert returned Article is the updated one
        $this->assertResponseContainKeyValue([
            'object'         => 'Article',
            'title'          => $data['title'],
            'content'        => $data['content'],
            'cover'          => $data['cover'],
            'status'         => '待审核',
            'guest_name'     => $this->article->guest->real_name,
            'guest_cover'    => $this->article->guest->cover,
            'guest_office'   => $this->article->guest->office,
            'comment_counts' => $this->article->comments->count(),
            'auditor'        => null,
            'audit_time'     => null,

        ]);

        $responseContent = $this->getResponseContentObject();

        $this->assertNotNull($responseContent->data->comments);

        // assert data was updated in the database
        $this->assertDatabaseHas('articles', [
            'title'   => $data['title'],
            'content' => $data['content'],
            'cover'   => $data['cover'],
            'status'  => 2,
        ]);
    }

    public function testUpdateNonExistingArticle_()
    {
        $this->getTestingGuestWithoutAccess();
        $data = [
            'title' => 'Updated Name',
        ];

        $fakeArticleId = 7777;

        // send the HTTP request
        $response = $this->injectId($fakeArticleId)->makeCall($data);

        // assert response status is correct
        $response->assertStatus(422);

        $this->assertResponseContainKeyValue([
            'status' => 'error'
        ]);
    }

    public function testUpdateExistingArticleWithoutData_()
    {
        $this->getTestingGuestWithoutAccess();
        // send the HTTP request
        $response = $this->makeCall();

        // assert response status is correct
        $response->assertStatus(422);

        $this->assertResponseContainKeyValue([
            'message' => 'The given data was invalid.'
        ]);
    }

    public function testUpdateExistingArticleWithEmptyValues()
    {
        $this->getTestingGuestWithoutAccess();
        $data = [
            'title' => '',
        ];

        // send the HTTP request
        $response = $this->makeCall($data);

        // assert response status is correct
        $response->assertStatus(422);

        $this->assertValidationErrorContain([
            // messages should be updated after modifying the validation rules, to pass this test
            'title' => 'title 值不能为空',
        ]);

    }
}
