<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Projet extends Model
{
    //
    public $timestamps = true;
    
    protected $fillable = [
        'nom_projet', 'id_user', 'id_client', 'description', 'date_debut', 'date_fin', 'cloture',
    ];
}
