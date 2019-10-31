<?php

namespace App\Http\Controllers;

use App\Twitter\Client as TwitterClient;
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Page size for entries
     * 
     * @var integer PAGE_SIZE
     */
    const PAGE_SIZE = 3;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $user->load('entries');
        $entries = $user->entries()->orderByDesc('created_at')->paginate(self::PAGE_SIZE);
        return view('users.show', compact('user', 'entries'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->update($request->all());
        $user->save();
        return redirect()->route('users.show', compact('user'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function tweets(User $user)
    {
        $client = new TwitterClient;
        return $client->getTweets($user->twitter_username);
    }

    public function hideTweets(User $user, $tweets_ids)
    {
        
    }
}
