<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Membre;

class Tontine extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'amount_per_person',
        'total_participants',
        'current_participants',
        'start_date',
        'status',
        'description'
    ];

    protected $dates = ['start_date'];

    protected $appends = [
        'total_contributions',
        'contribution_progress',
        'next_beneficiary'
    ];

    public function participants()
    {
        return $this->belongsToMany(Membre::class, 'tontine_participants', 'tontine_id', 'membre_id');
    }

    public function contributions()
    {
        return $this->hasMany(Contribution::class, 'tontine_id', 'id');
    }

    public function getTotalContributionsAttribute()
    {
        return $this->contributions->sum('amount');
    }

    public function getContributionProgressAttribute()
    {
        $totalExpected = $this->amount_per_person * $this->total_participants;
        $totalCollected = $this->total_contributions;
        return $totalExpected > 0 ? round(($totalCollected / $totalExpected) * 100, 2) : 0;
    }

    public function getNextBeneficiaryAttribute()
    {
        // Logique pour déterminer le prochain bénéficiaire
        // Cette méthode peut être complexifiée selon les règles spécifiques de la tontine
        return $this->participants->first();
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'en_cours');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'terminee');
    }

    public function scopeCancelled($query)
    {
        return $query->where('status', 'annulee');
    }
}
