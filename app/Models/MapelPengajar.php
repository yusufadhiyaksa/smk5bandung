<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MapelPengajar extends Model
{
    use HasFactory;
    protected $table = "mapel_pengajar";
    protected $fillable = ["mapel_id", "user_id"];

    protected function setKeysForSaveQuery($query)
    {
        $query
            ->where('mapel_id', '=', $this->getAttribute('mapel_id'))
            ->where('user_id', '=', $this->getAttribute('pengajar_id'));
        return $query;
    }
}
