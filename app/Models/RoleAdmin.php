<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleAdmin extends Model
{
    protected $table = 'roles_admin';

    protected $fillable = ['nom', 'permissions', 'actif', 'description'];

    protected $casts = [
        'permissions' => 'array',
        'actif' => 'boolean',
    ];

    public function admins()
    {
        return $this->hasMany(Admin::class, 'role_admin_id');
    }
}