<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Stmt\For_;

class Komentar extends Model
{
    use HasFactory;
    protected $table = 'komentar';
    protected $fillable = ["user_id", "forum_id", "kontent", "parent"];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function forum(){
        return $this->belongsTo(Forum::class);
    }
}
