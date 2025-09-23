<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Suivicommercial extends Model
{
    //
    public $timestamps = true;

    protected $fillable = [
        'id', 'title', 'color', 
        'start', 'end', 
        'id_projet', 'id_fournisseur', 'id_user',
        'more', 'date_relance', 'id_client'
    ];

   
    
}
