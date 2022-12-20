<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Department extends Model
{
    use HasFactory;
    protected $table = 'departments';
    protected $fillable = [
        'id',
        'name',
        'company_id'
    ];
    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function companies()
    {
        return $this->belongsTo(Company::class);
    }
}