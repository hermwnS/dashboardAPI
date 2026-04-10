<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataOrangModel extends Model
{
    protected $table = 'data_orang';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama',
        'alamat',
        'tanggal_lahir',
        'jenis_kelamin', 
        'usia', 
    ];
}
