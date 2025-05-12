<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    public $timestamps = true;
    protected $fillable = [
        'login',
        'password',
        'nom_prenoms',
        'departements_id',
        'poste',
        'active',
        'login_token',
        'count_login',
        'created_by'
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function permissions()
    {
        //dd($this->belongsToMany(Permission::class));
        return $this->belongsToMany(Permission::class);

    }

    public function hasPermission($permission)
    {
        //dd( $this->permissions()->where('libele', $permission)->first() !== null);
        return $this->permissions()->where('libele', $permission)->first() !== null;

    }

    public function hasAnyPermission($permissions)
    {
        //SI IL A SOIT UNE PERMISSION OU UNE AUTRE 
        return $this->permissions()->whereIn('libele', $permissions)->first() !== null;
    }
    
    public function hasRole($role)
    {
        return $this->roles()->where("intitule", $role)->first() !== null;
        //dd
    }

    public function hasAnyRole($role)
    {
        //SI IL A SOIT UNE PERMISSION OU UNE AUTRE 

       return $this->roles()->whereIn('intitule', $role)->first() !== null;
    
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**public function suivis(): BelongsTomany
    {
        return $this->belongsToMany(related: Suivicommercial::class);
    }**/
}
