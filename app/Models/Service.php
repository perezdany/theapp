<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    //
    public $timestamps = true;

    protected $fillable = [
        'libele_service', 'code', 'description', 'suspendu', 'id_user'
    ];

    public function cotations()
    {
        return $this->belongsToMany(Cotation::class);

    }

}
