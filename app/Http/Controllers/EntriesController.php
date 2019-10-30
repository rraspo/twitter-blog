<?php

namespace App\Http\Controllers;

use App\Entry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EntriesController extends Controller
{
    /**
     * Page size for entry index view
     * 
     * @var integer PAGE_SIZE
     */
    const PAGE_SIZE = 3;

    public function __construct()
    {
        return $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user    = Auth::user()->load('entries');
        $entries = $user->entries()->orderByDesc('created_at')->paginate(self::PAGE_SIZE);
        return view('entries.index', compact('entries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('entries.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Entry::create([
            'title'   => $request->title,
            'content' => $request->content,
            'user_id' => Auth::id()
        ]);
        return redirect()->route('entries.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function show(Entry $entry)
    {
        return view('entries.show', compact('entry'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function edit(Entry $entry)
    {
        $this->authorize('update', $entry);
        return view('entries.edit', compact('entry'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Entry $entry)
    {
        $entry->update($request->all());
        $entry->save();
        return redirect()->route('entries.show', ['entry_id' => $entry->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function destroy(Entry $entry)
    {
        Entry::delete($entry);
        return redirect()->route('entries.index');
    }
}
