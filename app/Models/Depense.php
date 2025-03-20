<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Depense extends Model
{
    //
    public $timestamps = true;
    protected $fillable = [
        'date_sortie',
        'montant',
        'nom_beneficiaire',
        'numero_cheque',
        'banque',
        'date_virement',
        'numero_virement',
        'objet',
        'id_user',
       
    ];
}
