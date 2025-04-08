<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Suivicommercial extends Model
{
    //
    public $timestamps = true;

    protected $fillable = [
        'id', 'title', 'colour', 
        'starts_at', 'ends_at', 
        'id_projet', 'id_fournisseur', 
        'id_client',  'id_user'
    ];

    protected $casts = [
        'starts_at' => 'datetime', 'ends_at' => 'datetime', 
    ];

    public function users(): BelongsTomany
    {
        return $this->belongsToMany(related: User::class);
    }
}
