<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Quizz;
use App\Models\QuizzImage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ImageRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class QuizzImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        'image' => 'file|required',
        'reponse' => 'string|required'
    ]);

    if ($data['image']) {
        $path = $data['image']->store('images', 'public');
        $data['image'] = 'storage/' . $path;
    }

    $quizzImage = QuizzImage::create($data);

    $quizz = new Quizz($data);

    $quizzImage->quizz()->save($quizz);

    return redirect()->back();
}


    /**
     * Display the specified resource.
     */
    public function show(quizzImage $quizzImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(quizzImage $quizzImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'question' => 'string|required',
            'image' => 'file|required',
            'reponse' => 'string|required'
        ]);

        if ($data['image']) {
            $path = $data['image']->store('images', 'public');
            $data['image'] = 'storage/' . $path;
        }

        $quizz = Quizz::findOrFail($id);
        $quizzImage = $quizz->quizzable;

        $quizz->update($data);
        $quizzImage->update($data); 

        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(quizzImage $quizzImage)
    {
        //
    }
}
