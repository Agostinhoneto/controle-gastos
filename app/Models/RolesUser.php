<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class RolesUser extends Model
{
    protected $fillable = ['id','user_id','role_id' ];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
