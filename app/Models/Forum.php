<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    use HasFactory;
    protected $table = 'forum';
    protected $fillable = ["user_id", "judul", "konten"];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function komentar(){
        return $this->hasMany(Komentar::class);
    }
}
