<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    public $timestamps = true;

    protected $fillable = [
        'intitule', 'description'
    ];

    public function users()
    {
        $this->belongsToMany(User::class, 'role_user', 'user_id', 'role_id');
    }
}
