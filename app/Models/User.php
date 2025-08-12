<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Model implements AuthenticatableContract, AuthorizableContract, JWTSubject
{
    use Authenticatable, Authorizable, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
    /**
     * Relação 1:1 com RoleUser.
     */
    public function roleUser()
    {
        return $this->hasOne(RoleUser::class, 'users_id');
    }

    /**
     * Acessor para facilitar acesso direto ao role.
     */
    protected $appends = ['role'];

    public function getRoleAttribute()
    {
        // Verifica se relação está carregada para evitar query extra
        if ($this->relationLoaded('roleUser') && $this->roleUser) {
            return $this->roleUser->role; // ou o nome da coluna que guarda o papel
        }

        // Carrega se não estiver carregada (pode causar N+1 em lista)
        return $this->roleUser ? $this->roleUser->role : null;
    }
}
