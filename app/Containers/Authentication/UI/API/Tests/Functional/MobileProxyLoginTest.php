<?php

namespace App\Containers\User\UI\API\Tests\Functional;

use App\Containers\Authentication\Tests\TestCase;
use App\Containers\Guest\Models\Guest;
use Illuminate\Support\Facades\DB;

/**
 * Class ProxyLoginTest
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class MobileProxyLoginTest extends TestCase
{

    protected $endpoint; // testing multiple endpoints form the tests

    protected $access = [
        'permissions' => '',
        'roles'       => '',
    ];

    private $testingFilesCreated = false;

    public function testClientWebMobileProxyLogin_()
    {
        $endpoint = 'post@v1/clients/web/mobile/login';

        // create data to be used for creating the testing user and to be sent with the post request
//        $guest = factory(Guest::class)->create();
        $data = [
            'name'     => $this->faker->name,
            'password' => $this->faker->unique()->name.uniqid(),
        ];

        $user = $this->getTestingGuestWithoutAccess($data);

        $this->actingAs($user, 'mobile_web');

        $clientId = '100';
        $clientSecret = 'XXp8x4QK7d3J9R7OVRXWrhc19XPRroHTTKIbY8XX';

        // create client
         DB::table('oauth_clients')->insert([
            [
                'id'                     => $clientId,
                'secret'                 => $clientSecret,
                'name'                   => 'Testing',
                'redirect'               => 'http://localhost',
                'password_client'        => '1',
                'personal_access_client' => '0',
                'revoked'                => '0',
            ],
        ]);

        // make the clients credentials available as env variables
        putenv('CLIENT_WEB_MOBILE_ID=' . $clientId);
        putenv('CLIENT_WEB_MOBILE_SECRET=' . $clientSecret);

        // create testing oauth keys files
        $publicFilePath = $this->createTestingKey('oauth-public.key');
        $privateFilePath = $this->createTestingKey('oauth-private.key');

        $response = $this->endpoint($endpoint)->makeCall($data);

        $response->assertStatus(200);

        $this->assertResponseContainKeyValue([
            'token_type' => 'Bearer',
        ]);

        $this->assertResponseContainKeys(['expires_in', 'access_token']);

        // delete testing keys files if they were created for this test
        if ($this->testingFilesCreated) {
            unlink($publicFilePath);
            unlink($privateFilePath);
        }
    }


    public function testClientWebMobileProxyLoginError_()
    {
        $endpoint = 'post@v1/clients/web/mobile/login';

        // create data to be used for creating the testing user and to be sent with the post request
        $guest = factory(Guest::class)->create();
        $data = [
            'name'     => $guest->name,
            'password' => $guest->open_id,
        ];

        $user = $this->getTestingGuestWithoutAccess($data);
        $this->actingAs($user, 'mobile_web');

        $clientId = '100';
        $clientSecret = 'XXp8x4QK7d3J9R7OVRXWrhc19XPRroHTTKIbY8XX';

        // create client
         DB::table('oauth_clients')->insert([
            [
                'id'                     => $clientId,
                'secret'                 => $clientSecret,
                'name'                   => 'Testing',
                'redirect'               => 'http://localhost',
                'password_client'        => '1',
                'personal_access_client' => '0',
                'revoked'                => '0',
            ],
        ]);

        // make the clients credentials available as env variables
        putenv('CLIENT_WEB_MOBILE_ID=' . $clientId);
        putenv('CLIENT_WEB_MOBILE_SECRET=' . $clientSecret);

        // create testing oauth keys files
        $publicFilePath = $this->createTestingKey('oauth-public.key');
        $privateFilePath = $this->createTestingKey('oauth-private.key');

        $login_data = [
            'name'     => $guest->name,
            'password' => 'dfsdfsdafsadfsadfsa',
        ];

        $response = $this->endpoint($endpoint)->makeCall($login_data);

        $response->assertStatus(200);
        $this->assertResponseContainKeyValue([
            'status'  => false,
            'msg' => "账号信息获取有误",
        ]);

        // delete testing keys files if they were created for this test
        if ($this->testingFilesCreated) {
            unlink($publicFilePath);
            unlink($privateFilePath);
        }
    }

    /**
     * @param $fileName
     *
     * @return  string
     */
    private function createTestingKey($fileName)
    {
        $filePath = storage_path($fileName);

        if (!file_exists($filePath)) {
            $keysStubDirectory = __DIR__ . '/Stubs/';

            copy($keysStubDirectory . $fileName, $filePath);

            $this->testingFilesCreated = true;
        }

        return $filePath;
    }
}
