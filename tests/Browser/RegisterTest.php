<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Artisan;

class RegisterTest extends DuskTestCase
{
    /**
     * Waiting time constant
     * 
     * @var integer WAIT_TIME
     */
    const WAIT_TIME = 3000;

    /**
     * Faker reference
     */
    protected $faker;

    private function setupTest()
    {
        $this->faker = Faker::create();
    }

    /**
     * Create user.
     *
     * @return void
     */
    public function testRegister()
    {
        try {
            $this->setupTest();
            $username         = $this->faker->userName;
            $email            = $this->faker->email;
            $twitter_username = 'ELCANSERBERO';
            $this->browse(function (Browser $browser) use ($username, $email, $twitter_username) {
                $browser->visit('/')
                    ->click('@register')
                    ->type('username', $username)
                    ->type('email', $email)
                    ->type('twitter_username', $twitter_username)
                    ->type('password', 'password')
                    ->type('password_confirmation', 'password')
                    ->press('Register')
                    ->pause(self::WAIT_TIME)
                    ->assertSee("Welcome, $username")
                    ->click('@user-menu')
                    ->click('@logout');
            });
            $this->assertDatabaseHas('users', ['email' => $email]);
        } catch (\Throwable $th) {
            throw $th;
        } finally {
            $this->cleanDatabase();
        }
    }

    private function cleanDatabase()
    {
        Artisan::call('migrate:refresh');
    }
}
