<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use App\Models\QuizzImage;
use App\Models\VraiFaux;
use App\Models\Qcm;

class Quizz extends Model
{
    use HasFactory;

    protected $fillable = ['question','reponse'];

    public function quizzable(): MorphTo
    {
        return $this->morphTo();
    }
}
