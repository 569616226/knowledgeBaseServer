<?php

namespace App\Containers\Topic\UI\API\Tests\Functional;

use App\Containers\Tests\TestCase;

/**
 * Class FindUsersTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class FindTopicArticleAnswersTest extends TestCase
{

    protected $endpoint = 'get@v1/topic_article_answers';
    protected $access = [
        'permissions' => null,
        'roles'       => null,
    ];


    public function testFindTopicArticleAnswers_()
    {
        $page_count = 10;
        $page_index = 3;

        $this->getTestingGuestWithoutAccess();
        // send the HTTP request
        $response = $this->endpoint($this->endpoint . '?page_index=' . $page_index . '&page_count=' . $page_count)->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertNotNull($responseContent->data);

    }

}
