<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('publishers.index', [
            'title' => 'Publishers',
            'publishers' => Publisher::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('publishers.create', [
            'title' => 'New Publisher'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255|unique:publishers',
            'address' => 'required|max:255'
        ]);

        Publisher::create($validatedData);

        return redirect('/publishers')->with('success', 'New publisher has been added');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Publisher $publisher)
    {
        return view('publishers.edit', [
            'title' => 'Edit Publisher',
            'publisher' => $publisher
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Publisher $publisher)
    {
        $rules = [
            'name' => 'required|max:255',
            'address' => 'required'
        ];
        
        if($request->name != $publisher->name){
            $rules['name'] = 'required|unique:publishers|max:255';
        }

        $validatedData = $request->validate($rules);

        Publisher::where('id', $publisher->id)->update($validatedData);

        return redirect('/publishers')->with('success', 'Publisher has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Publisher $publisher)
    {
        if(count($publisher->books) > 0){
            return redirect('/publishers')->with('warning', 'Publisher is used in other table');
        } else {
            Publisher::destroy($publisher->id);
            return redirect('/publishers')->with('danger', 'Publisher has been deleted');
        }
    }
}
