<?php

namespace App\Http\Controllers;

use App\Models\VraiFaux;
use App\Models\Quizz;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VraiFauxController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vraiFaux = VraiFaux::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'question' => 'string|required',
            'reponse' => 'string|required'
        ]);
       
        $quizzVf = VraiFaux::create([]);
    
        $quizz = new Quizz($data);
    
        $quizzVf->quizz()->save($quizz);
    
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'question' => 'string|required',
            'reponse' => 'string|required'
        ]);

        $quizz = Quizz::findOrFail($id);
        $quizzVf = $quizz->quizzable;

        $quizz->update($data);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
