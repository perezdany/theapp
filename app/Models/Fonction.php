<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fonction extends Model
{
    //

    public $timestamps = true;

    protected $fillable = [
        'libele_fonction',
        'id_user'
    ];
}
