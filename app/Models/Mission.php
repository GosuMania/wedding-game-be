<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'parola_cruciverba',
        'selfie_sposa',
        'selfie_sposo',
        'brindisi',
        'video_brindisi',
        'parola_jenga',
        'indovinello',
        'punteggio',
        'date'
    ];
}
