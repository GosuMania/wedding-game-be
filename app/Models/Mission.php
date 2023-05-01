<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'id_utente',
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

    public function user()
    {
        return $this->belongsTo(User::class, 'id_utente'); // appartiene a
    }
}
