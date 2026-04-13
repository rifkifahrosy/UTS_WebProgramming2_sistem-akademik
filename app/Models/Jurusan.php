<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jurusan extends Model
{
    use HasFactory;

    protected $table = 'jurusan';
    protected $primaryKey = 'id_jurusan';

    protected $fillable = [
        'nama_jurusan',
        'akreditasi',
    ];

    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class, 'id_jurusan', 'id_jurusan');
    }

    public function matakuliah()
    {
        return $this->hasMany(Matakuliah::class, 'id_jurusan', 'id_jurusan');
    }
}
