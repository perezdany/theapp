<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    //
    public $timestamps = true;

    protected $fillable = [
        'paiement', 'id_facture', 'date_paiement', 
        'date_virement', 'numero_virement',
        'banque', 'id_user'

    ];

    public function factures()
    {
        return $this->belongsTo(Facture::class, 'id_facture', 'id');
    }
}
