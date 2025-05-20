<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    //
    public $timestamps = true;

    protected $fillable = [
       'paiement', 'id_facture', 'id_mode_reglement', 'id_user'

    ];

    public function factures()
    {
        return $this->belongsTo(Facture::class, 'id_facture', 'id');
    }
}
