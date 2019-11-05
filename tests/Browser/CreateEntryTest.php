<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Faker\Factory as Faker;
use App\User;
use Illuminate\Support\Facades\Artisan;

class CreateEntryTest extends DuskTestCase
{
    /**
     * Waiting time constant
     * 
     * @var integer WAIT_TIME
     */
    const WAIT_TIME = 3000;

    /**
     * User reference
     * 
     * @var App\User $user
     */
    protected $user;

    /**
     * Faker reference
     */
    protected $faker;

    private function setupTest()
    {
        $this->user = factory(User::class)->create([
            'email'            => "juanabrahamporras@gmail.com",
            'twitter_username' => 'ELCANSERBERO'
        ]);
        $this->faker = Faker::create();
    }

    /**
     * Create user.
     *
     * @return void
     */
    public function testCreateEntry()
    {
        try {
            $this->setupTest();
            $this->browse(function (Browser $browser) {
                $title = $this->faker->realText(20);
                $content = $this->faker->realText;
                $image_url = $this->faker->imageUrl() ?? "https://loremflickr.com/240/240";
                $browser->visit('/login')
                    ->type('email', $this->user->email)
                    ->type('password', 'password')
                    ->press('Login')
                    ->pause(self::WAIT_TIME)
                    ->assertSee('Newest user entries');
                $browser->click('@new-entry')
                    ->type('title', $title)
                    ->type('content', $content)
                    ->type('image_url', $image_url)
                    ->press('Save')
                    ->pause(self::WAIT_TIME)
                    ->assertSee($title)
                    ->assertSee($content);
            });
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
