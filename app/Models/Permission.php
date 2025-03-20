<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    //
    public $timestamps = true;

    protected $fillable = ['libele'];


    public function users()
    {
        return $this->belongsToMany(User::class, 'permissions_user', 'permission_id', 'user_id');

    }
}
