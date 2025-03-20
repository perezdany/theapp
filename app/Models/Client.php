<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //
    public $timestamps = true;
    protected $fillable = [
        'nom', 'adresse', 'id_statutclient', 'particulier', 'telephone', 'activite', 
        'adresse_email', 'adresse_facturation', 'numero_contribuable', 'id_user',
    ];
}
