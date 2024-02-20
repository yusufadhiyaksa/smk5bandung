<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;
    protected $table = "materi_ajar";
    protected $fillable = ["user_id", "mapel_id", "judul_materi", "pembuat_materi", "deskripsi_materi", "link_materi", "cover_foto"];
}
