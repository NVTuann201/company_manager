<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Company extends Model
{
    use HasFactory;
    protected $table = 'companies';
    protected $fillable = [
        'id',
        'name',
        'address'
    ];
    protected function departments () {
        return $this->hasMany(Department::class);
    }

    public function getAllCompanies()
    {
        $list = DB::table('companies')->get();
        // dd($list);
        return $list;
    }

    public function addCompany($data)
    {
        // dd($data);
        return DB::table($this->table)->insert([
            'name' => $data[0],
            'address' => $data[1],
        ]);
    }

    public function getCompany($id)
    {
        $company = DB::table('companies')->where('id', $id)->get();

        return $company;
    }

    public function updateCompany($data, $id)
    {
        // dd($data);
        DB::table('companies')->where('id', $id)->update([
            'name' => $data[0],
            'address' => $data[1],
        ]);
    }

    public function deleteCompany($id)
    {
        DB::table('companies')->where('id', $id)->delete();
    }
}
