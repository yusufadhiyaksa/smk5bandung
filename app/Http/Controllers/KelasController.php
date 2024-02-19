<?php
namespace App\Http\Controllers;

    use App\Models\Jurusan;
    use App\Models\Kelas;
    use App\Models\User;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\DB;

    class KelasController extends Controller
    {
        public function index($jurusanId) //show collection of data
        {
            $subtitle = DB::table('jurusan')
                    ->select('nama_jurusan')
                    ->where('id', $jurusanId)
                    ->first();
            $kelasTitle = "Kelas di Jurusan " . $subtitle->nama_jurusan;
            viewShare([
                
                "cardTitle" => $kelasTitle,
                "title" =>  "Kelas",
                "kelass" => DB::table('kelas')
                            ->join('users', 'kelas.pengajar_id', '=', 'users.id')
                            ->select('kelas.*', 'users.name as nama_pengajar')
                            ->where('kelas.jurusan_id', $jurusanId)
                            ->get()
            ]);
            return response()->view("kelas.index");
        }

        public function create() //formnya
        {
            viewShare([
                "title" => "Create Kelas",
                "jurusans" => Jurusan::all(),
                "users" => User::whereHas('role', function ($q) {
                    $q->where('name', 'pengajar');
                })->get(),             
            ]);
            return response()->view("kelas.create");
        }

        public function edit($jurusanId, $id) //formnya
        {
            viewShare([
                "title" => "Edit Kelas",
                "jurusans" => Jurusan::all(),
                "users" => User::whereHas('role', function ($q) {
                    $q->where('name', 'pengajar');
                })->get(),            
                "kelass" => DB::table('kelas')
                            ->select('kelas.*')
                            ->where('kelas.id', $id)
                            ->get()
            ]);
            return response()->view("kelas.edit");
        }

        public function store($jurusanId)
        {
            $data = request()->validate([
                'nama_kelas' => 'required',
                'jumlah_siswa' => 'required|integer|min:1', // Validasi jumlah siswa harus diisi dan harus berupa angka integer yang lebih dari 0
                'tingkat' => 'required',
                'pengajar_id' => 'required',
            ]);
            $data = request()->post();
            Kelas::create($data);

            return redirect()->route("kelas.index", $jurusanId)->with("success", "Berhasil menambahkan data kelas");
        }

        public function update($jurusanId, $id)
        {
            $data = request()->post();
            $kelas = Kelas::findOrFail($id); // Misalnya Anda memiliki id kelas dalam data POST
            $kelas->update($data);
            return redirect()->route("kelas.index", $jurusanId)->with("success", "Berhasil memperbarui data kelas");
        }

        public function destroy($jurusanId, $id)
        {
            $kelas = Kelas::find($id);
            if (!$kelas) {
                return redirect()->route("kelas.index", $jurusanId)->with("error", "Data kelas tidak ditemukan");
            }
        
            if ($kelas->delete()) {
                return redirect()->route("kelas.index", $jurusanId)->with("success", "Data kelas berhasil dihapus");
            } else {
                return redirect()->route("kelas.index", $jurusanId)->with("error", "Gagal menghapus data kelas");
            }
        }
    }
