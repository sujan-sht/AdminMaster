<?php

namespace SujanSht\LaraAdmin\Models\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function users()
    {
        return $this->belongsToMany(User::class, 'role_users')->withTimestamps();
    }

    public function permissions()
    {
        return $this->hasMany(Permission::class, 'role_id');
    }
}
