<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Epargne extends Model
{
    use HasFactory;

    /**
     * La table associée au modèle.
     *
     * @var string
     */
    protected $table = 'epargnes';

    /**
     * Les attributs qui sont assignables en masse.
     *
     * @var array
     */
    protected $fillable = [
        'membre_id',
        'montant',
        'type',
        'date',
        'statut',
        'objectif',
        'description'
    ];

    /**
     * Les attributs qui doivent être convertis en types natifs.
     *
     * @var array
     */
    protected $casts = [
        'montant' => 'decimal:2',
        'objectif' => 'decimal:2',
        'date' => 'date'
    ];

    /**
     * Les valeurs par défaut pour les attributs.
     *
     * @var array
     */
    protected $attributes = [
        'statut' => 'actif'
    ];

    /**
     * Obtenir le membre associé à cette épargne.
     */
    public function membre()
    {
        return $this->belongsTo(Membre::class, 'membre_id', 'id_membre');
    }

    /**
     * Scope pour les épargnes actives.
     */
    public function scopeActives($query)
    {
        return $query->where('statut', 'actif');
    }

    /**
     * Scope pour les épargnes en attente.
     */
    public function scopeEnAttente($query)
    {
        return $query->where('statut', 'en_attente');
    }

    /**
     * Calculer le pourcentage atteint de l'objectif.
     */
    public function getProgressionAttribute()
    {
        if (!$this->objectif || $this->objectif == 0) {
            return 0;
        }
        return round(($this->montant / $this->objectif) * 100);
    }

    /**
     * Calculer le montant restant pour atteindre l'objectif.
     */
    public function getMontantRestantAttribute()
    {
        if (!$this->objectif) {
            return 0;
        }
        return max(0, $this->objectif - $this->montant);
    }

    /**
     * Vérifier si l'objectif est atteint.
     */
    public function getObjectifAtteintAttribute()
    {
        if (!$this->objectif) {
            return false;
        }
        return $this->montant >= $this->objectif;
    }

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($epargne) {
            if (!$epargne->date) {
                $epargne->date = now();
            }
            if (!$epargne->statut) {
                $epargne->statut = 'actif';
            }
        });
    }
}
