<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class companies extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'address'
    ];
    protected function departments () {
        return $this->hasMany(Department::class);
    }
}
