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
        public function detail($id){
            viewShare([
                "cardTitle" => "Detail Materi Ajar",
                "title" => "Materi",
                "materis"=>DB::table('materi_ajar')
                            ->join('mapel', 'materi_ajar.mapel_id', '=', 'mapel.id')
                            ->join('users', 'materi_ajar.user_id', '=', 'users.id')
                            ->select('materi_ajar.*', 'mapel.nama_mapel', 'users.name')
                            ->where('materi_ajar.id', $id)
                            ->get()
                
            ]);
            return response()->view("allmateri.detail");
        }
        public function show()
        {
            $keyword = request()->input('keyword'); 
            $userId = Auth::user()->id;
            $materis = DB::table('materi_ajar')
                ->join('mapel', 'materi_ajar.mapel_id', '=', 'mapel.id')
                ->join('mapel_pengajar', 'mapel.id', '=', 'mapel_pengajar.mapel_id')
                ->select('materi_ajar.*', 'mapel.nama_mapel')
                ->where('mapel_pengajar.user_id', $userId)
                ->get();
            // Filtering materi using Boyer-Moore algorithm
            $filteredMateris = $this->boyerMooreFilter($materis, $keyword);
            view()->share([
                "cardTitle" => "Hasil Pencarian Materi Ajar",
                "title" => "Pencarian Materi Ajar",
                "materis" => $filteredMateris,
            ]);
            return view("allmateri.show");
        }

        private function boyerMooreFilter($materis, $keyword)
        {
            $filteredMateris = collect([]);
            foreach ($materis as $materi) {
                $judul_materi_lower = strtolower($materi->judul_materi);
                $deskripsi_materi_lower = strtolower($materi->deskripsi_materi);
                
                // Memeriksa kecocokan untuk setiap kata dalam deskripsi dan judul materi
                if ($this->boyerMooreSearch($judul_materi_lower, $keyword) || $this->boyerMooreSearch($deskripsi_materi_lower, $keyword)) {
                    $filteredMateris->push($materi);
                }
            }
            return $filteredMateris;
        }

        private function boyerMooreSearch($text, $pattern)
        {
            $keywords = explode(" ", $pattern); // Pisahkan keyword menjadi array kata
            foreach ($keywords as $keyword) {
                // Implementasikan pencarian Boyer-Moore untuk setiap kata
                $n = strlen($text);
                $m = strlen($keyword);
                $occurrences = [];
                // Preprocessing: compute bad character shift table
                $badCharShift = [];
                for ($i = 0; $i < 256; $i++) {
                    $badCharShift[chr($i)] = $m;
                }
                for ($i = 0; $i < $m - 1; $i++) {
                    $badCharShift[$pattern[$i]] = $m - $i - 1;
                }
                // Searching
                $i = $m - 1;
                while ($i < $n) {
                    $k = $m - 1;
                    $j = $i;
                    while ($k >= 0 && $text[$j] == $pattern[$k]) {
                        $j--;
                        $k--;
                    }
                    if ($k < 0) {
                        // Pattern found
                        return true;
                    } else {
                        // Shift based on bad character rule
                        $i += max(1, $badCharShift[$text[$i]]);
                    }
                }
            }
            return false;
        }
}
