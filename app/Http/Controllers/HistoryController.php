<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\History;
use App\Models\User;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('histories.index', [
            'title' => 'Histories',
            'histories' => History::with('user', 'book')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('histories.create', [
            'title' => 'New History',
            'users' => User::all(),
            'books' => Book::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required',
            'book_id' => 'required',
            'borrow_until' => 'required|after:now'
        ]);

        $validatedData['borrow_from'] = now();

        History::create($validatedData);

        return redirect('/histories')->with('success', 'New history has been added');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(History $history)
    {
        return view('histories.edit', [
            'title' => 'Edit History',
            'history' => $history,
            'users' => User::all(),
            'books' => Book::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, History $history)
    {
        $validatedData = $request->validate([
            'user_id' => 'required',
            'book_id' => 'required',
            'borrow_from' => 'required|before:now',
            'borrow_until' => 'required|after:borrow_from'
        ]);

        History::where('id', $history->id)->update($validatedData);

        return redirect('/histories')->with('success', 'History has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(History $history)
    {
        History::destroy($history->id);
        return redirect('/histories')->with('danger', 'History has been deleted');
    }
}
