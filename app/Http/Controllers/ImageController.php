<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Image;
use App\Models\Album;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ImageRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // eager loading
        $images = Image::with('albums')->get(); 
        $albums = Album::all();
            return Inertia::render('Admin/Adminimage', [
                'images' => $images,
                'albums' => $albums,
            ]);
    }

    public function indexPublic(){
        $images = Image::with('albums')->get(); 
        $albums = Album::all();
        return Inertia::render('Galerie', [
            'images' => $images,
        ]);
    }

    public function getImagesByAlbum($albumId)
    {
        $images = Image::whereHas('albums', function ($query) use ($albumId) {
        $query->where('album_id', $albumId);
        })->get();
        return $images;
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
public function store(Request $request){
    
    $data = $request->validate([
        'description' => 'string|nullable',
        'url' => 'array|required', 
        'url.*' => 'file|mimes:jpeg,png', 
        'album' => 'nullable'
    ]);

    $images = [];

    if ($data['url']) {
        foreach ($data['url'] as $file) {
            $path = $file->store('images', 'public');
            $images[] = ['url' => 'storage/' . $path, 'description' => $data['description']];
        }
    }

    foreach ($images as $imageData) {
        $image = Image::create($imageData);

        // Si vous souhaitez gérer la relation many-to-many avec l'entité Album
        if ($data['album'] && is_string($data['album'])) {
            $albums = explode(',', $data['album']);
            $albums = array_map('intval', $albums);

            foreach ($albums as $albumId) {
                $image->albums()->attach($albumId);
            }
        }
    }

    return redirect()->back();
}


    public function show($id)
    {
        $image = Image::findOrFail($id);
        $url = Storage::url($image->path);
        return redirect($url);
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
    public function update(Request $request, $id)
    {
    $data = $request->validate([
        'description' => 'string|nullable',
        'url' => 'file|required',
        'album' => 'nullable'
    ]); 
    // dd($data);
    $image = Image::findOrFail($id);

    // Vérifier si le champ "url" est envoyé avec le formulaire
    if ($data['url']) {
        $path = $data['url']->store('images', 'public');
        $data['url'] = 'storage/' . $path;
    }

    $image->albums()->detach();
    if ($data['album'] && is_string($data['album'])) {
        $albums = explode(',', $data['album']);
        $albums = array_map('intval', $albums);

        foreach ($albums as $albumId) {
            $image->albums()->attach($albumId);
        }
    }

    $image->update($data);
    return redirect()->back();
    }

    public function destroy($id)
    {
    // Trouver l'image à supprimer
    $image = Image::findOrFail($id);
    
    $image->albums()->detach();
    $image->delete();

    $imagePath = 'storage/images/' . basename($image->url);
    if(File::exists($imagePath)){
    File::delete($imagePath);
    }
    

    return redirect()->back();
    }
}
