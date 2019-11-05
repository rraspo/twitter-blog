<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\User;
use Illuminate\Support\Facades\Artisan;

class TweetToggleTest extends DuskTestCase
{
    /**
     * Waiting time constant
     * 
     * @var integer WAIT_TIME
     */
    const WAIT_TIME = 4000;

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
    public function testTweetToggle()
    {
        try {
            $this->setupTest();
            $this->browse(function ($author, $reader) {
                $author->visit('/login')
                    ->type('email', $this->user->email)
                    ->type('password', 'password')
                    ->press('Login')
                    ->pause(self::WAIT_TIME)
                    ->click('@user-menu')
                    ->click('@my-entries')
                    ->pause(self::WAIT_TIME)
                    ->click('@toggle-anchor-0');
                $hiddenTweetText = $author->text('@tweet-text-0');
                $shownTweetText  = $author->text('@tweet-text-1');
                $reader->visit("/users/{$this->user->id}")
                    ->pause(self::WAIT_TIME)
                    ->assertDontSee($hiddenTweetText)
                    ->assertSee($shownTweetText);
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
