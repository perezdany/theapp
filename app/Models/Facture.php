<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    //
    public $timestamps =  true;

    protected $fillable = [
         'numero_facture', 'numero_avoir', 'date_reglement', 'date_emission', 
         'montant_facture', 'id_cotation', 'reglee', 'annulee', 'id_user', 'file_path', 
    ];

}
