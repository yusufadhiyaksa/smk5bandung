<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Mapel;
use Illuminate\Support\Facades\DB;

class MapelController extends Controller
{
    public function index($jurusanId) //show collection of data
    {
        $subtitle = DB::table('jurusan')
        ->select('nama_jurusan')
        ->where('id', $jurusanId)
        ->first();
        $mapelTitle = "Mapel di Jurusan " . $subtitle->nama_jurusan;
        viewShare([
            
            "cardTitle" => $mapelTitle,
            "title" =>  "Mepel",
            "mapels" => Mapel::where("jurusan_id", $jurusanId)->get()
        ]);
        return response()->view("mapel.index");
        
    }

    public function create() //formnya
    {
        viewShare([
            "title" => "Create Mapel",
            "jurusans" => Jurusan::all()
        ]);
        return response()->view("mapel.create");
    }

    public function edit($jurusanId, $id) //formnya
    {
        viewShare([
            "title" => "Edit Mepel",
            "jurusans" => Jurusan::all(),
            "mapels" => DB::table('mapel')
                        ->select('mapel.*')
                        ->where('mapel.id', $id)
                        ->get()
        ]);
        return response()->view("mapel.edit");
    }

    public function store($jurusanId)
    {
        $data = request()->validate([
            'nama_mapel' => 'required',
            'fase' => 'required', // Validasi jumlah siswa harus diisi dan harus berupa angka integer yang lebih dari 0
            'muatan' => 'required',
            'capaian_mapel' => 'required'

        ]);
        $data = request()->post();
        Mapel::create($data);

        return redirect()->route("mapel.index", $jurusanId)->with("success", "Berhasil menambahkan data mapel");
    }

    public function update($jurusanId, $id)
    {
        $data = request()->post();
        $mapel = Mapel::findOrFail($id); // Misalnya Anda memiliki id kelas dalam data POST
        $mapel->update($data);
        return redirect()->route("mapel.index", $jurusanId)->with("success", "Berhasil memperbarui data kelas");
    }

    public function destroy($jurusanId, $id) //proses hapus
    {
        $mapel = Mapel::find($id);
        if (!$mapel) {
            return redirect()->route("mapel.index", $jurusanId)->with("error", "Data mapel tidak ditemukan");
        }
    
        if ($mapel->delete()) {
            return redirect()->route("mapel.index", $jurusanId)->with("success", "Data mapel berhasil dihapus");
        } else {
            return redirect()->route("mapel.index", $jurusanId)->with("error", "Gagal menghapus data mapel");
        }
    }
    public function detail($jurusanId, $id){
        viewShare([
            "title" => "Detail Mapel",  
            "pageTitle"=>"Detail Mapel",
            "mapels" => DB::table('mapel')
                        ->select('mapel.*')
                        ->where('mapel.id', $id)
                        ->get(),
            "elemens" => DB::table('elemen')
                        ->select('elemen.*')
                        ->where('elemen.mapel_id', $id)
                        ->get(),
            "capaians" => DB::table('capaian_pembelajaran')
                        ->join('elemen', 'capaian_pembelajaran.elemen_id', '=', 'elemen.id')
                        ->select('capaian_pembelajaran.*')
                        ->where('elemen.mapel_id', $id)
                        ->get()
        ]);
        return response()->view("mapel.detail");
    }
}
