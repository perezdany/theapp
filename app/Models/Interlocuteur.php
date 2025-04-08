<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Interlocuteur extends Model
{
    //

    public $timestamps = true;

    protected $fillable = [
        'titre', 'i_nom', 'prenom', 'tel', 
        'email', 'id_fonction', 'id_client', 
        'id_user'
    ];
}
