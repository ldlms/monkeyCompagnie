<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Evenement;
use App\Models\Image;

class Equipier extends Model
{
    use HasFactory;

    protected $fillable = ['nom','description','image'];

    // public function image(){
    //     return $this->belongsTo(Image::class);
    // }

    // public function evenements(){
    //     return $this->hasMany(Evenement::class);
    // }
}
