<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Album;
use App\Models\Image;
use App\Models\Evenement;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
            $images = Image::with('albums')->get(); 
            $albums = Album::with('images')->get();
            return Inertia::render('Admin/Adminalbum', [
                'images' => $images,
                'albums' => $albums,
        ]);

    }

    public function indexPublic(){
        $images = Image::with('albums')->get(); 
        $albums = Album::with('images')->get();
        $now = Carbon::now();
        $thirtyDaysFromNow = $now->copy()->addDays(30);
        $evenements = Evenement::where('date','>',$now)
        ->where('date', '<', $thirtyDaysFromNow)
        ->orderByDesc('date')
        ->get();
            return Inertia::render('Galerie',[
                'images' => $images,
                'albums' => $albums,
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
        // dd($data);

        $album = Album::create($data);
    
        // Si vous souhaitez gérer la relation many-to-many avec l'entité Album
        if ($request->has('image') && is_string($request->input('image'))) {
            $images = explode(',', $request->input('image'));
            $images = array_map('intval', $images);
    
            foreach ($images as $imageId) {
                $album->images()->attach($imageId);
            }
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
    $album = Album::findOrFail($id);
    $images = $album->images;
    $evenements = Evenement::orderByDesc('date')->get();
    return Inertia::render('Album',[
        'album' => $album,
        'images' => $images,
        'evenements' => $evenements
    ]); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Album $album)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $album = Album::findOrFail($id);

        $album->images()->detach();
        if ($request->has('image') && is_string($request->input('image'))) {
            $images = explode(',', $request->input('image'));
            $images = array_map('intval', $images);
    
            foreach ($images as $imageId) {
                $album->images()->attach($imageId);
            }
        }

        $album->update($data);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $album = Album::findOrFail($id);

        $album->images()->detach();
        $album->delete();
        return redirect()->back();
    }
}
