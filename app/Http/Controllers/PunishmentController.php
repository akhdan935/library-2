<?php

namespace App\Http\Controllers;

use App\Models\Punishment;
use Illuminate\Http\Request;

class PunishmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('punishments.index', [
            'title' => 'Punishments',
            'punishments' => Punishment::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('punishments.create', [
            'title' => 'New Punishment'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255|unique:punishments'
        ]);

        Punishment::create($validatedData);

        return redirect('/punishments')->with('success', 'New punishment has been added');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Punishment $punishment)
    {
        return view('punishments.edit', [
            'title' => 'Edit Punishment',
            'punishment' => $punishment
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Punishment $punishment)
    {
        $rules = [
            'name' => 'required|max:255'
        ];
        
        if($request->name != $punishment->name){
            $rules['name'] = 'required|unique:punishments';
        }

        $validatedData = $request->validate($rules);

        Punishment::where('id', $punishment->id)->update($validatedData);

        return redirect('/punishments')->with('success', 'Punishment has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Punishment $punishment)
    {
        if(count($punishment->punishes) > 0){
            return redirect('/punishments')->with('warning', 'Punishment is used in other table');
        } else {
            Punishment::destroy($punishment->id);
            return redirect('/punishments')->with('danger', 'Punishment has been deleted');
        }
    }
}
