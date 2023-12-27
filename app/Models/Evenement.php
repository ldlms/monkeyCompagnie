<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Image;
use App\Models\Equipier;

class Evenement extends Model
{
    use HasFactory;

    protected $fillable = ['nom','jour','mois','heure','lieu','metro','date','image'];

}
