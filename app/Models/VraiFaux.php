<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Quizz;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class VraiFaux extends Model
{
    use HasFactory;

    public function quizz(): MorphOne
    {
        return $this->morphOne('App\Models\VraiFaux', 'quizzable');
    }

    public function getMorphClass()
    {
    return 'Vraifaux';
    }
}
