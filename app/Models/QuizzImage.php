<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Quizz;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class QuizzImage extends Model
{
    use HasFactory;

    protected $fillable = ['image'];

    public function quizz(): MorphOne
    {
        return $this->morphOne('App\Models\Quizz', 'quizzable');
    }

    public function getMorphClass()
    {
    return 'QuizzImage';
    }
}
