<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'nome',
        'cognome',
        'nome_utente',
        'punteggio',
        'id_mission',
        'date'
    ];

    public function mission()
    {
        return $this->belongsTo(Mission::class, 'id_mission'); // appartiene a
    }
}
