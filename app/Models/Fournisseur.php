<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
    //
    public $timestamps = true ;

    protected $fillable = [
         'nom', 'telephone', 'id_user'
    ];
}
