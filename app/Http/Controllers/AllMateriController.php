<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Materi;
use App\Models\Mapel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AllMateriController extends Controller
{
    public function index() //show collection of data
        {
            $userId= Auth::user()->id;
            viewShare([
                "cardTitle" => "Cari Materi Ajar",
                "title" => "Materi",
                "materis"=>DB::table('materi_ajar')
                            ->join('mapel', 'materi_ajar.mapel_id', '=', 'mapel.id')
                            ->join('mapel_pengajar', 'materi_ajar.mapel_id', '=', 'mapel_pengajar.mapel_id')
                            ->select('materi_ajar.*', 'mapel.nama_mapel')
                            ->where('mapel_pengajar.user_id', $userId)
                            ->get()
                
            ]);
            return response()->view("allmateri.index");
        }
        public function show($materi_id) //show collection of data
        {
            $userId= Auth::user()->id;
            viewShare([
                "cardTitle" => "Materi Ajar",
                "title" => "Detail Materi",
                "materis"=>DB::table('materi_ajar')
                            ->join('mapel', 'materi_ajar.mapel_id', '=', 'mapel.id')
                            ->select('materi_ajar.*', 'mapel.nama_mapel')
                            ->where('materi_ajar.id', $materi_id)
                            ->get()
                
            ]);
            return response()->view("allmateri.show");
        }
}
