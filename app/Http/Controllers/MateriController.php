<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Materi;
use App\Models\Mapel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class MateriController extends Controller
{
    public function index() //show collection of data
        {
            $userId= Auth::user()->id;
            viewShare([
                "cardTitle" => "Materi Yang Saya Upload",
                "title" => "Materi",
                "materis"=>DB::table('materi_ajar')
                            ->join('mapel', 'materi_ajar.mapel_id', '=', 'mapel.id')
                            ->select('materi_ajar.*', 'mapel.nama_mapel')
                            ->where('materi_ajar.user_id', $userId)
                            ->get()
                
            ]);
            return response()->view("materi.index");
        }

        public function create() //formnya
        {
            $userId= Auth::user()->id;
            viewShare([
                "title" => "Create Mapel",
                "userId"=>$userId,
                "mapels" => DB::table('mapel')
                                        ->join('mapel_pengajar', 'mapel_pengajar.mapel_id', '=', 'mapel.id')
                                        ->select('mapel.*')
                                        ->where('mapel_pengajar.user_id', $userId)
                                        ->get()
                
            ]);

            return response()->view("materi.create");
        }

        public function edit($materiId) //formnya
        {
            $userId= Auth::user()->id;
            viewShare([
                "title" => "Create Mapel",
                "userId"=>$userId,
                "mapels" => DB::table('mapel')
                                        ->join('mapel_pengajar', 'mapel_pengajar.mapel_id', '=', 'mapel.id')
                                        ->select('mapel.*')
                                        ->where('mapel_pengajar.user_id', $userId)
                                        ->get(),
                "materis"=>DB::table('materi_ajar')
                            ->join('mapel', 'materi_ajar.mapel_id', '=', 'mapel.id')
                            ->select('materi_ajar.*', 'mapel.nama_mapel')
                            ->where('materi_ajar.id', $materiId)
                            ->get()
            ]);

            return response()->view("materi.edit");
        }

        public function store(Request $request)
        {
            $validatedData = $request->validate([
                'user_id' => 'required', // Ubah sesuai dengan kebutuhan validasi
                'mapel' => 'required', // Ubah sesuai dengan kebutuhan validasi
                'judul_materi' => 'required', // Ubah sesuai dengan kebutuhan validasi
                'pembuat_materi' => 'required', // Ubah sesuai dengan kebutuhan validasi
                'deskripsi_materi' => 'required', // Ubah sesuai dengan kebutuhan validasi
                'link_materi' => 'required', // Ubah sesuai dengan kebutuhan validasi
                'cover_foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Ubah sesuai dengan kebutuhan validasi
            ]);
            $coverFotoPath = $request->file('cover_foto')->store('cover-materi');
            // Buat entri baru di database menggunakan model MateriAjar
            $materi = new Materi();
            $materi->user_id = $request->user_id;
            $materi->mapel_id = $request->mapel;
            $materi->judul_materi = $request->judul_materi;
            $materi->pembuat_materi = $request->pembuat_materi;
            $materi->deskripsi_materi = $request->deskripsi_materi;
            $materi->link_materi = $request->link_materi;
            $materi->cover_foto = $coverFotoPath;
            $materi->save();
        // Redirect ke halaman index atau halaman lain yang diinginkan
        return redirect()->route('materi.index')->with('success', 'Materi berhasil disimpan');
          
        }

        public function update(Request $request, $materiId)
        {
            $validatedData = $request->validate([
                'mapel' => 'required', // Ubah sesuai dengan kebutuhan validasi
                'judul_materi' => 'required', // Ubah sesuai dengan kebutuhan validasi
                'pembuat_materi' => 'required', // Ubah sesuai dengan kebutuhan validasi
                'deskripsi_materi' => 'required', // Ubah sesuai dengan kebutuhan validasi
                'link_materi' => 'required', // Ubah sesuai dengan kebutuhan validasi
                'cover_foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Ubah sesuai dengan kebutuhan validasi
            ]);
            
            $materi = Materi::findOrFail($materiId);
        
            // Jika ada file cover baru diunggah, hapus yang lama dari storage
            if ($request->hasFile('cover_foto')) {
                Storage::delete($materi->cover_foto);
                $coverFotoPath = $request->file('cover_foto')->store('cover-materi');
                $materi->cover_foto = $coverFotoPath;
            }
        
            // Update atribut lainnya
            $materi->mapel_id = $request->mapel;
            $materi->judul_materi = $request->judul_materi;
            $materi->pembuat_materi = $request->pembuat_materi;
            $materi->deskripsi_materi = $request->deskripsi_materi;
            $materi->link_materi = $request->link_materi;
            $materi->save();
        
            // Redirect ke halaman index atau halaman lain yang diinginkan
            return redirect()->route('materi.index')->with('success', 'Materi berhasil diperbarui');
        }

        public function destroy($materiId)
        {
            // Temukan materi berdasarkan ID
            $materi = Materi::findOrFail($materiId);

            // Hapus file cover dari storage
            if ($materi->cover_foto) {
                Storage::delete($materi->cover_foto);
            }

            // Hapus materi dari database
            $materi->delete();

            // Redirect ke halaman index atau halaman lain yang diinginkan
            return redirect()->route('materi.index')->with('success', 'Materi berhasil dihapus');
        }
}
