<?php

namespace App\Http\Controllers;

use App\Models\Qcm;
use App\Models\Quizz;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QCMController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $qcm = Qcm::all();
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
            'choix1' => 'string|required',
            'choix2' => 'string|required',
            'choix3' => 'string|required',
            'choix4' => 'string|required',
            'reponse' => 'string|required'
        ]);
    
        $quizzQcm = Qcm::create($data);
    
        $quizz = new Quizz($data);
    
        $quizzQcm->quizz()->save($quizz);
    
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
            'choix1' => 'string|required',
            'choix2' => 'string|required',
            'choix3' => 'string|required',
            'choix4' => 'string|required',
            'reponse' => 'string|required'
        ]);

        $quizz = Quizz::findOrFail($id);
        $quizzQcm = $quizz->quizzable;

        $quizz->update($data);
        $quizzQcm->update($data);

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
