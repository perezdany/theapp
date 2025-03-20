<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //
    public $timestamps = true;
    protected $fillable = [
        'designation',
        'code',
        'prix_unitaire',
        'id_typearticle',
        'id_user',
    ];
}
