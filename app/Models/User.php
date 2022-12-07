<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Laravel\Lumen\Auth\Authorizable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends UuidModel implements AuthenticatableContract, AuthorizableContract, JWTSubject
{
    use Authenticatable, Authorizable, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'username',
        'phone',
        'password',
        'roles',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'roles' => 'array',
        'phone' => 'string'
    ];


    //jwt setting part

    /**
     * @inheritDoc
     */
    public function getJWTIdentifier()
    {
        // TODO: Implement getJWTIdentifier() method.
        return $this->getKey();
    }

    /**
     * @inheritDoc
     */
    public function getJWTCustomClaims()
    {
        // TODO: Implement getJWTCustomClaims() method.
        return [];
    }

    //relation
    public function admin()
    {
        return $this->hasOne(Admin::class, 'user_id');
    }


    //scopes

    /**
     * @param Builder $query
     * @param $username
     * @return Builder
     */
    public function scopeRoleAdmin($query, $username)
    {
        return $query->whereJsonContains('roles', 'admin')
            ->with(['admin'])
            ->where('username', '=', $username);
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeActiveAdmin($query)
    {
        return $query->whereHas('admin', function ($q) {
            return $q->where('is_active', '=', true);
        });
    }
}
