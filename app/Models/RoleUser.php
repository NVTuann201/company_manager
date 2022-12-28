<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    use HasFactory;
    protected $table = 'role_user';
    protected $fillable = [
        'id',
        'user_id',
        'role_id'
    ];
    protected function roles()
    {
        return $this->hasOne(User::class);
    }
    protected function users()
    {
        return $this->hasOne(Role::class);
    }
}