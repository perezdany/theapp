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
        'id_typearticle',
        'id_user',
    ];

    public function cotations()
    {
        return $this->belongsToMany(Cotation::class);

    }
}
