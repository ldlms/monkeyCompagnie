<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Equipier;
use App\Models\Evenement;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File; 

class EquipierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
            $equipiers = Equipier::all();
            return Inertia::render('Admin/Adminequipier', [
            'equipiers' => $equipiers
            ]);
    }

    public function indexPublic(){

        $equipiers = Equipier::all();
        $now = Carbon::now();
        $thirtyDaysFromNow = $now->copy()->addDays(30); 
        $evenements = Evenement::where('date','>',$now)
        ->where('date', '<', $thirtyDaysFromNow)
        ->orderByDesc('date')
        ->get();
            return Inertia::render('Equipe',[
                'equipiers' => $equipiers,
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
        $data = $request->all();
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $data['image'] = 'storage/' . $path;
        }

        $equipier = Equipier::create($data);
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
        $data = $request->all();
        $equipier = Equipier::findOrFail($id);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $data['image'] = 'storage/' . $path;
        }

        $equipier->update($data);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    $equipier = Equipier::findOrFail($id);
    $equipier->delete();

    
    $imagePath = 'storage/images/' . basename($equipier->image);
    if(File::exists($imagePath)){
        File::delete($imagePath);
    }
    return redirect()->back();
    }
}
