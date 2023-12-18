<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('authors.index', [
            'title' => 'Authors',
            'authors' => Author::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('authors.create', [
            'title' => 'New Author'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:authors'
        ]);

        Author::create($validatedData);

        return redirect('/authors')->with('success', 'New author has been added');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Author $author)
    {
        return view('authors.edit', [
            'title' => 'Edit Author',
            'author' => $author
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Author $author)
    {
        $rules = [
            'name' => 'required|max:255'
        ];

        if($request->email != $author->email){
            $rules['email'] = 'required|unique:authors';
        }
        
        $validatedData = $request->validate($rules);

        Author::where('id', $author->id)->update($validatedData);

        return redirect('/authors')->with('success', 'Author has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author)
    {
        if(count($author->books) > 0){
            return redirect('/authors')->with('warning', 'Author is used in other table');
        } else {
            Author::destroy($author->id);
            return redirect('/authors')->with('danger', 'Author has been deleted');
        }
    }
}
