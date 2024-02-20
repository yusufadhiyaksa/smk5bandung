<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Jurusan;
use Illuminate\Support\Facades\DB;

class JurusanController extends Controller
{
    public function index() //show collection of data
        {
            viewShare([
                "cardTitle" => "Daftar Jurusan di SMKN 5 Bandung",
                "title" => "Jurusan",
                "jurusans" => Jurusan::all(),
                
            ]);
            return response()->view("jurusan.index");
        }

        public function create() //formnya
        {
            viewShare([
                "title" => "Create Jurusan",             
            ]);
            return response()->view("jurusan.create");
        }

        public function edit($jurusanId) //formnya
        {
            viewShare([
                "title" => "Edit Jurusan",
                "jurusans" => DB::table('jurusan')
                            ->select('jurusan.*')
                            ->where('jurusan.id', $jurusanId)
                            ->get()
            ]);
            return response()->view("jurusan.edit");
        }

        public function store()
        {
            $data = request()->validate([
                'nama_jurusan' => 'required'
            ]);
            $data = request()->post();
            Jurusan::create($data);

            return redirect()->route("jurusan.index")->with("success", "Berhasil menambahkan data kelas");
        }

        public function update($jurusanId)
        {
            $data = request()->post();
            $jurusan = Jurusan::findOrFail($jurusanId); // Misalnya Anda memiliki id kelas dalam data POST
            $jurusan->update($data);
            return redirect()->route("jurusan.index")->with("success", "Berhasil memperbarui data kelas");
        }

        public function destroy($jurusanId)
        {
            $jurusan = Jurusan::find($jurusanId);
            if (!$jurusan) {
                return redirect()->route("jurusan.index")->with("error", "Data kelas tidak ditemukan");
            }
        
            if ($jurusan->delete()) {
                return redirect()->route("jurusan.index")->with("success", "Data kelas berhasil dihapus");
            } else {
                return redirect()->route("jurusan.index")->with("error", "Gagal menghapus data kelas");
            }
        }
}
