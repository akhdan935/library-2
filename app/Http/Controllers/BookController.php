<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('books.index', [
            'title' => 'Books',
            'books' => Book::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('books.create', [
            'title' => 'New Book',
            'authors' => Author::all(),
            'publishers' => Publisher::all(),
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'cover' => 'required|image|file|max:1024',
            'author_id' => 'required',
            'publisher_id' => 'required',
            'category_id' => 'required'
        ]);

        $validatedData['cover'] = $request->file('cover')->store('cover');

        Book::create($validatedData);

        return redirect('/books')->with('success', 'New book has been added');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return view('books.details', [
            'title' => 'Details Book',
            'book' => Book::with('author', 'publisher', 'category')->where('id', $book->id)->first()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        return view('books.edit', [
            'title' => 'Edit Book',
            'book' => $book,
            'authors' => Author::all(),
            'publishers' => Publisher::all(),
            'categories' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $rules = [
            'title' => 'required|max:255',
            'cover' => 'image|file|max:1024',
            'author_id' => 'required',
            'publisher_id' => 'required',
            'category_id' => 'required'
        ];

        $validatedData = $request->validate($rules);

        if($request->file('cover')){
            if($book->cover){
                Storage::delete($book->cover);
            }
            $validatedData['cover'] = $request->file('cover')->store('cover');
        }

        Book::where('id', $book->id)->update($validatedData);

        return redirect('/books')->with('success', 'Book has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        if(count($book->histories) > 0){
            return redirect('/books')->with('warning', 'Book is used in other table');
        } else {
            if($book->cover){
                Storage::delete($book->cover);
            }
            Book::destroy($book->id);
            return redirect('/books')->with('danger', 'Book has been deleted');
        }
    }
}
