<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Equipier;
use App\Models\Evenement;
use App\Models\Quizz;
use App\Models\Album;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['url','description'];


    public function albums(){
        return $this->belongsToMany(Album::class,'album_image');
    }

    // public function url()
    // {
    //     // Retourner l'URL de l'image sans le préfixe "/galerie/"
    //     return asset(str_replace('/galerie/', '', $this->path));
    // }
}
