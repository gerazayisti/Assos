<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Tontine;
use App\Models\Membre;

class Contribution extends Model
{
    use HasFactory;

    protected $fillable = [
        'tontine_id',
        'membre_id',
        'amount',
        'contribution_date',
        'description'
    ];

    protected $dates = ['contribution_date'];

    public function tontine()
    {
        return $this->belongsTo(Tontine::class);
    }

    public function membre()
    {
        return $this->belongsTo(Membre::class, 'membre_id', 'id_membre');
    }
}
