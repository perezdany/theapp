<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Typearticle extends Model
{
    //
    public $timestamps = true;

    protected $fillable = [
        'libele', 'id_user'
    ];

}
