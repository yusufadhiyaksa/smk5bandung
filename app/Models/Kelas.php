<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;
    protected $table = "kelas";
    protected $fillable = ["jurusan_id", "tingkat", "nama_kelas", "pengajar_id", "jumlah_siswa"];
}
