<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    //
    public $timestamps = true;
    protected $fillable = [
        'libele_departement',
       
    ];
}
