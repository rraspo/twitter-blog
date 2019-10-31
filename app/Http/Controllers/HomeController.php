<?php

namespace App\Http\Controllers;

use App\Entry;

class HomeController extends Controller
{
    /**
     * Page size for homepage entry index
     * 
     * @var integer PAGE_SIZE
     */
    const PAGE_SIZE = 3;

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function login()
    {
        return view('auth.login');
    }

    /**
     * Show the application entries.
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home()
    {
        $entries = Entry::with('author')->orderByDesc('created_at')->paginate(self::PAGE_SIZE);
        return view('welcome', compact('entries'));
    }
}
