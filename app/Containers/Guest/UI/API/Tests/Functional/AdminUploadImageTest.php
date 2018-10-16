<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/28
 * Time: 13:53
 */

namespace App\Containers\Guest\UI\API\Tests\Functional;


use App\Containers\Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class AdminUploadImageTest extends TestCase
{

    protected $endpoint = 'post@v1/admin/upload_image';
    protected $access = [
        'permissions' => null,
        'roles'       => null,
    ];

    public function testUploadImageSuccess_(){

        $data = [
            'img_url' => UploadedFile::fake()->image('card_pic.jpg'),
        ];

        // send the HTTP request
        $response = $this->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertResponseContainKeys(['img_url']);
        $img_url = explode('/',$responseContent->img_url)[4];
        Storage::disk('public')->assertExists($img_url);

    }

    public function testUploadImageError_()
    {

        $data = [
            'img_url' => '',
        ];

        // send the HTTP request
        $response = $this->makeCall($data);

        // assert response status is correct
        $response->assertStatus(422);

    }

}