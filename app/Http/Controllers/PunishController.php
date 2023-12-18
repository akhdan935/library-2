<?php

namespace App\Http\Controllers;

use App\Models\Punish;
use App\Models\Punishment;
use App\Models\User;
use Illuminate\Http\Request;

class PunishController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('punishes.index', [
            'title' => 'Punishes',
            'punishes' => Punish::with('user', 'punishment')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('punishes.create', [
            'title' => 'New Punish',
            'users' => User::all(),
            'punishments' => Punishment::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required',
            'punishment_id' => 'required'
        ]);

        Punish::create($validatedData);

        return redirect('/punishes')->with('success', 'New punish has been added');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Punish $punish)
    {
        return view('punishes.edit', [
            'title' => 'Edit Punish',
            'punish' => $punish,
            'users' => User::all(),
            'punishments' => Punishment::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Punish $punish)
    {
        $validatedData = $request->validate([
            'user_id' => 'required',
            'punishment_id' => 'required'
        ]);

        Punish::where('id', $punish->id)->update($validatedData);

        return redirect('/punishes')->with('success', 'Punish has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Punish $punish)
    {
        Punish::destroy($punish->id);
        return redirect('/punishes')->with('danger', 'Punish has been deleted');
    }
}
