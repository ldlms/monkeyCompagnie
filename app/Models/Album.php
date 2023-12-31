<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Image;

class Album extends Model
{
    use HasFactory;

    protected $fillable = [ 'titre'];

    public function images(){
        return $this->belongsToMany(Image::class,'album_image');
    }
}
