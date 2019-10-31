<?php

namespace App\Twitter;

use TwitterAPIExchange;

/**
 * Class Client
 * 
 * @package App\Twitter
 * 
 */
class Client
{
    /**
     * Base URL for Twitter 
     */
    const BASE_URL = "https://api.twitter.com/1.1/";

    /**
     * Array with common used URIs
     */
    const URIS = [
        "tweets" => "statuses/user_timeline.json",
        "user"   => "users/show.json",
    ];

    /**
     * Get Http verb 
     */
    const GET = 'GET';

    /**
     * URI variable to use different Twitter resources
     * 
     * @var string $uri
     */
    protected $uri;

    /**
     * Twitter client
     * 
     * @var TwitterAPIExchange $twitterClient
     */
    protected $twitterClient;

    /**
     * Create a new Twitter Client
     * 
     * @param mixed $config
     */
    public function __construct()
    {
        $settings = array(
            'oauth_access_token'        => config("services.twitter.access"),
            'oauth_access_token_secret' => config("services.twitter.access_secret"),
            'consumer_key'              => config("services.twitter.consumer"),
            'consumer_secret'           => config("services.twitter.consumer_secret"),
        );
        $this->twitterClient = new TwitterAPIExchange($settings);
    }

    /**
     * Get the Twitter timeline for specified user
     * 
     * @return Illuminate\Support\Collection
     */
    public function getTweets($username = '')
    {
        $result = $this->twitterClient
            ->setGetfield("?screen_name=$username")
            ->buildOauth(self::BASE_URL.self::URIS["tweets"], 'GET')
            ->performRequest();
        $result = collect(json_decode($result));
        if ($result->has('errors')) { 
            return $result->get('errors');
        } else {
            return $result;
        }
        return collect($result);
    }
}