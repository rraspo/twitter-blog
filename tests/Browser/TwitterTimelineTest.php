<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\User;
use Illuminate\Support\Facades\Artisan;

class TwitterTimelineTest extends DuskTestCase
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

    private function setupTest()
    {
        $this->user = factory(User::class)->create([
            'email'            => "juanabrahamporras@gmail.com",
            'twitter_username' => 'ELCANSERBERO'
        ]);
    }

    /**
     * Create user.
     *
     * @return void
     */
    public function testTwitterTimeline()
    {
        try {
            $this->setupTest();
            $this->browse(function (Browser $browser) {
                $browser->visit('/login')
                    ->type('email', $this->user->email)
                    ->type('password', 'password')
                    ->press('Login')
                    ->pause(self::WAIT_TIME)
                    ->assertSee('Newest user entries');
                $browser->click('@user-menu')
                    ->pause(self::WAIT_TIME)
                    ->click('@my-entries')
                    ->pause(self::WAIT_TIME)
                    ->assertDontSee('Not found or inaccessible.');
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
