<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Depense extends Model
{
    //
    public $timestamps = true;
    protected $fillable = [
        'date_sortie', 'montant', 'numero', 'objet', 'id_user'
       
    ];
}
