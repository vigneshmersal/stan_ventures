<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role', 'status', 'created_by', 'updated_by', 'deleted_by'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'deleted_at' => 'datetime'
    ];

    /*
    |--------------------------------------------------------------------------
    | Scope query
    |--------------------------------------------------------------------------
     */
    public function scopeAdmin($query) { return $query->where("role", "admin"); }
    public function scopeUser($query) { return $query->where("role", "user"); }

    /*
    |--------------------------------------------------------------------------
    | Scope check
    |--------------------------------------------------------------------------
     */
    public function scopeIsAdmin() { return $this->role == "admin"; }
    public function scopeIsActive() { return $this->status == 1; }

    /*
    |--------------------------------------------------------------------------
    | Get methods
    |--------------------------------------------------------------------------
     */
    public function getActiveAttribute() { return $this->status == 1 ? 'Active' : 'InActive'; }
}
