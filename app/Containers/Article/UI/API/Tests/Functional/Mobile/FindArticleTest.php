<?php

namespace App\Containers\Article\UI\API\Tests\Functional\Mobile;

use App\Containers\Tests\TestCase;

/**
 * Class FindArticlesTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class FindArticleTest extends TestCase
{

    protected $endpoint = 'get@v1/articles/mobile/detail/{id}';

    protected $access = [
        'roles'       => '',
        'permissions' => '',
    ];

    public function testFindArticles_()
    {
        $this->getTestingGuestWithoutAccess();
        // send the HTTP request
        $response = $this->injectId($this->article->id)->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertEquals($this->article->title, $responseContent->data->title);
        $this->assertEquals($this->article->content, $responseContent->data->content);
        $this->assertEquals($this->article->cover, $responseContent->data->cover);
        $this->assertEquals($this->refund_audit_status[$this->article->status], $responseContent->data->status);
        $this->assertEquals($this->article->remark, $responseContent->data->remark);
        $this->assertEquals($this->article->auditor, $responseContent->data->auditor);
        $this->assertEquals($this->article->audit_time, $responseContent->data->audit_time);
        $this->assertEquals($this->article->comments->count(), $responseContent->data->comment_counts);
        $this->assertEquals($this->article->readers, $responseContent->data->readers);
        $this->assertEquals(count($this->article->like), $responseContent->data->like);

        $this->assertNotNull($responseContent->data->comments);
    }

}
