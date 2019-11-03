<?php

namespace App\Http\Controllers;

use App\HiddenTweet;
use App\User;
use App\Twitter\Client as TwitterClient;

class TweetsController extends Controller
{

    /**
     * Return a collection of tweets
     * 
     * @return Illuminate\Support\Collection
     */
    public function tweets(User $user)
    {
        $client = new TwitterClient;
        $tweets = $client->getTweets($user->twitter_username);
        $hidden = $this->getHiddenTweets($user);
        $tweets->transform(function ($tweet) use ($hidden) {
            $tweet->hidden = $hidden->contains($tweet->id_str);
            return $tweet;
        });
        return $tweets;
    }

    /**
     * Return hidden tweets
     */
    public function getHiddenTweets(User $user)
    {
        return HiddenTweet::whereUserId($user->id)->get();
    }

    /**
     * Hide a specific tweet.
     * 
     * @return bool true|false
     */
    public function toggleHide(User $user, $tweet_id)
    {
        try {
            $hidden = HiddenTweet::where([
                "tweet_id_str" => $tweet_id,
                "user_id"      => $user->id
            ])->first();
            if ($hidden) {
                $hidden->delete();
            } else {
                HiddenTweet::create([
                    "tweet_id_str" => $tweet_id,
                    "user_id"      => $user->id
                ]);
            }
            return "true";
        } catch (\Throwable $th) {
            return "false";
        }
    }
}
