<?php

namespace App\Containers\Message\UI\API\Tests\Functional;

use App\Containers\Message\Models\Message;
use App\Containers\Tests\TestCase;

/**
 * Class FindMessagesTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class FindMessageTest extends TestCase
{

    protected $endpoint = 'get@v1/messages/{id}';

    protected $access = [
        'roles'       => '',
        'permissions' => 'manage-messages',
    ];

    public function testFindMessages_()
    {
        $message = factory(Message::class)->create(['is_read' => 0]);

        // send the HTTP request
        $response = $this->injectId($message->id)->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $reciver_names = implode('、', $message->guests->pluck('name')->toArray());

        $this->assertEquals($message->sender, $responseContent->data->sender);
        $this->assertEquals($message->title, $responseContent->data->title);
        $this->assertEquals($message->group_name, $responseContent->data->group_name);
        $this->assertEquals($reciver_names, $responseContent->data->reciver_names);
        $this->assertEquals($message->content, $responseContent->data->content);
        $this->assertFalse($responseContent->data->is_read);
        $this->assertEquals($message->img_url  , $responseContent->data->img_url);
        $this->assertEquals($this->msg_type[$message->msg_type], $responseContent->data->msg_type);
    }

}
