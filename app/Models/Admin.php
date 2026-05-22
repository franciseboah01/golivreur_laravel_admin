<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'nom', 'prenom', 'email', 'telephone', 'password',
        'role_admin_id', 'zone_id', 'statut_validation', 'actif', 'created_by', 'last_login',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'actif' => 'boolean',
        'last_login' => 'datetime',
        'password' => 'hashed',
    ];

    public function createur()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    public function adminsCrees()
    {
        return $this->hasMany(Admin::class, 'created_by');
    }

   public function hasPermission($permission)
    {
        $role = $this->roleAdmin;
        if ($role && $role->actif) {
            $permissions = $role->permissions ?? [];
            return in_array('*', $permissions) || in_array($permission, $permissions);
        }
        return false;
    }

    public function roleAdmin()
    {
        return $this->belongsTo(RoleAdmin::class, 'role_admin_id');
    }

    public function zone()
    {
        return $this->belongsTo(Zone::class, 'zone_id');
    }
}