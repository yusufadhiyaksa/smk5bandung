<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CapaianPemeblajaran extends Model
{
    use HasFactory;
    protected $table = "mapel";
    protected $fillable = ["elemen_id", "capaian"];
}
