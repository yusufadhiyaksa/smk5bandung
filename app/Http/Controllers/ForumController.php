<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ForumController extends Controller
{
    public function index(){
        viewShare([
            "title" => "Forum",
            "pageTitle"=>"Forum Diskusi" ,
            "cardTitle"=>"List Forum",
            "forums" => DB::table('forum')
                        ->join('users', 'forum.user_id', '=', 'users.id')
                        ->select('forum.*', 'users.name', 'users.profile_image')
                        ->get()
        ]);
        return view('forum.index');
    }
    public function create() {
        viewShare([
            "title" => "Forum",
            "pageTitle"=>"Forum Diskusi" ,
            "cardTitle"=>"Buat Forum Diskusi",
        ]);
        return view('forum.create');
    }

    public function store()
        {
            $data = request()->validate([
                'judul' => 'required'
            ]);
            $data = request()->post();
            Forum::create($data);

            return redirect()->route("forum.index")->with("success", "Berhasil menambahkan forum baru");
        }
        public function edit($id) //formnya
        {
            viewShare([
                "title" => "Edit Kelas",
                "forums" => DB::table('forum')
                            ->select('forum.*')
                            ->where('forum.id', $id)
                            ->get()
            ]);
            return response()->view("forum.edit");
        }
        public function update($id)
        {
            $data = request()->post();
            $forum = Forum::findOrFail($id); // Misalnya Anda memiliki id kelas dalam data POST
            $forum->update($data);
            return redirect()->route("forum.index")->with("success", "Berhasil Mengubah Postingan");
        }

        public function destroy($id)
        {
            $forum = Forum::find($id);
            if (!$forum) {
                return redirect()->route("forum.index")->with("error", "Forum tidak ditemukan");
            }
        
            if ($forum->delete()) {
                return redirect()->route("forum.index")->with("success", "Forum berhasil dihapus");
            } else {
                return redirect()->route("forum.index")->with("error", "Gagal menghapus Forum");
            }
        }
}
