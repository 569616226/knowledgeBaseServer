<?php

namespace App\Ship\Parents\Tests\PhpUnit;

use Apiato\Core\Abstracts\Tests\PhpUnit\TestCase as AbstractTestCase;
use App\Containers\Guest\Models\Guest;
use Faker\Generator;
use Illuminate\Contracts\Console\Kernel as ApiatoConsoleKernel;

use Illuminate\Foundation\Testing\WithFaker;
/**
 * Class TestCase
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
abstract class TestCase extends AbstractTestCase
{
    use WithFaker;

    /**
     * Setup the test environment, before each test.
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
    }

    /**
     * Reset the test environment, after each test.
     */
    public function tearDown()
    {
        parent::tearDown();
    }

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $this->baseUrl = env('API_FULL_URL'); // this reads the value from `phpunit.xml` during testing

        // override the default subDomain of the base URL when subDomain property is declared inside a test
        $this->overrideSubDomain();

        $app = require __DIR__ . '/../../../../../bootstrap/app.php';

        $app->make(ApiatoConsoleKernel::class)->bootstrap();

        // create instance of faker and make it available in all tests
        $this->faker = $app->make(Generator::class);

        return $app;
    }



    /**
     * Try to get the last logged in Guest, if not found then create new one.
     * Note: if $guestDetails are provided it will always create new guest, even
     * if another one was previously created during the execution of your test.
     *
     *
     * @param null $guestDetails what to be attached on the Guest object
     *
     * @return  \App\Containers\Guest\Models\Guest
     */
    public function getTestingGuest($guestDetails = null, $access = null)
    {
        return is_null($guestDetails) ? $this->findOrCreateTestingGuest($guestDetails, $access)
            : $this->createTestingGuest($guestDetails, $access);
    }

    /**
     * Same as `getTestingGuest()` but always overrides the Guest Access
     * (roles and permissions) with null. So the user can be used to test
     * if unauthorized user tried to access your protected endpoint.
     *
     * @param null $guestDetails
     *
     * @return  \App\Containers\Guest\Models\Guest
     */
    public function getTestingGuestWithoutAccess($guestDetails = ['status' => 3])
    {
        return $this->getTestingGuest($guestDetails, $this->getNullAccess());
    }


    /**
     * @param $guestDetails
     * @param $access
     *
     * @return  \App\Containers\Guest\Models\Guest
     */
    private function findOrCreateTestingGuest($guestDetails, $access)
    {
        return $this->createTestingGuest($guestDetails, $access);
    }

    /**
     * @param null $guestDetails
     *
     * @return  Guest
     */
    private function createTestingGuest($guestDetails = null, $access = null)
    {
        // create new guest
        $guest = $this->factoryCreateGuest($guestDetails);
        // assign user roles and permissions based on the access property
        $guest = $this->setupTestingGuestAccess($guest, $access);

        // authentication the guest
        $this->actingAs($guest, 'mobile_api');

        // set the created guest
        return $this->testingGuest = $guest;
    }

    /**
     * @param $guest
     * @param $access
     *
     * @return  mixed
     */
    private function setupTestingGuestAccess($guest, $access)
    {
        $access = $access ? : $this->getAccess();

        return $guest;
    }

    /**
     * @return  array|null
     */
    private function getAccess()
    {
        return isset($this->access) ? $this->access : null;
    }

    /**
     * @param null $guestDetails
     *
     * @return  Guest
     */
    private function factoryCreateGuest($guestDetails = null)
    {

        $guest = factory(Guest::class)->create($this->prepareGuestDetails($guestDetails));

        return $guest;

    }

    /**
     * @param null $guestDetails
     *
     * @return  array
     */
    private function prepareGuestDetails($guestDetails = null)
    {
        $open_id = $this->faker->unique()->name;

        $defaultGuestDetails = [
            'open_id'        => $open_id,
            'name'           => $this->faker->name,
            'avatar'         => $this->faker->imageUrl(60,60),
            'password'       => \Illuminate\Support\Facades\Hash::make($open_id),
            'phone'          => 13413381448,
            'email'          => $this->faker->unique()->safeEmail,
            'we_name'        => $this->faker->name,
            'city'           => $this->faker->word,
            'single_profile' => $this->faker->word,
            'office'         => $this->faker->word,
            'cover'          => $this->faker->imageUrl(60,60),
            'location'       => $this->faker->word,
            'card_id'        => $this->faker->creditCardNumber,
            'card_pic'       => $this->faker->imageUrl(60,60),
            'referee'        => $this->faker->word,
            'remark'         => $this->faker->word,
            'profile'        => $this->faker->word,
            'status'         => $this->faker->numberBetween(0,3),
            'gender'         => $this->faker->numberBetween(0,2),
            'like_linkas'    => [],
            'viewed_linkas'  => [],
        ];

        if($guestDetails){
            if(array_key_exists('password',$guestDetails)){
                $guestDetails['password'] = \Illuminate\Support\Facades\Hash::make($guestDetails['password']);
            }

            return $guestDetails;
        }else{
            return $defaultGuestDetails ;
        }
    }

    /**
     * @return  array
     */
    private function getNullAccess()
    {
        return [
            'permissions' => null,
            'roles'       => null
        ];
    }

}
