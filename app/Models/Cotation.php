<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cotation extends Model
{
    //
    public $timestamps = true;
    
    protected $fillable = [
        'date_creation', 'numero_devis', 'date_validite', 
        'id_client', 'id_condition', 'delais_livraison', 'dispo', 'valide', 'rejete', 'motif', 'id_user', 
    ];

    public function services()
    {
        return $this->belongsToMany(Service::class);

    }

    public function articles()
    {
        return $this->belongsToMany(Article::class);

    }
}

