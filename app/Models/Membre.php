<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Membre extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_membre';
    protected $table = 'membres';

    protected $fillable = [
        'nom',
        'prenom',
        'date_naissance',
        'lieu_naissance',
        'sexe',
        'telephone',
        'email',
        'adresse',
        'profession',
        'date_adhesion',
        'statut',
        'photo_path',
        'role',
        'numero_membre',
        'mot_de_passe'
    ];

    protected $dates = [
        'date_naissance',
        'date_adhesion',
        'derniere_connexion'
    ];

    protected $casts = [
        'date_naissance' => 'date',
        'date_adhesion' => 'date',
        'derniere_connexion' => 'datetime'
    ];
}
