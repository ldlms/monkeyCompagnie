<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Quizz;
use App\Models\QuizzImage as QuizzImage;
use App\Models\VraiFaux as Vraifaux;
use App\Models\Qcm as Qcm;
use App\Models\Evenement;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ImageRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Facades\File;

class QuizzController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    $quizz = Quizz::with('quizzable')->get();
    return Inertia::render('Admin/Adminquizz', [
        'quizzs' => $quizz,
    ]);
    }

    public function indexPublic(){
        $quizzs = Quizz::with('quizzable')->get();
        $now = Carbon::now();
        $thirtyDaysFromNow = $now->copy()->addDays(30); 
        $evenements = Evenement::where('date','>',$now)
        ->where('date', '<', $thirtyDaysFromNow)
        ->orderByDesc('date')
        ->get();
            return Inertia::render('Quizz',[
            'quizzs' => $quizzs,
            'evenements' => $evenements
        ]);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $quizz = Quizz::findOrFail($id);
    
        if ($quizz->quizzable instanceof VraiFaux) {
        
            $quizz->quizzable->delete();
        }

        if ($quizz->quizzable instanceof QCM) {
        
            $quizz->quizzable->delete();
        }

        if ($quizz->quizzable instanceof QuizzImage) {
        
            $quizz->quizzable->delete();
        }
    
        $quizz->delete();

        $imagePath = 'storage/images/' . basename($quizz->image);
        if(File::exists($imagePath)){
        File::delete($imagePath);
        }

        return redirect()->back();
    }
}
