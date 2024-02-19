<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Mapel;
use App\Models\MapelPengajar;
use Illuminate\Support\Facades\DB;

class MapelPengajarController extends Controller
{
    public function index()
    {
        $roles = DB::table('user_has_role')
            ->join('roles', 'user_has_role.role_id', '=', 'roles.id')
            ->where('roles.name', 'pengajar')
            ->pluck('roles.id');
        viewShare([
            "cardTitle" => "Pengajar di SMKN 5 Bandung",
            "title" =>  "Pengajar",
            "users" => DB::table('users')
                            ->join('user_has_role', 'user_has_role.user_id', '=', 'users.id')
                            ->select('users.*')
                            ->whereIn('user_has_role.role_id', $roles)
                            ->get()
        ]);
        return response()->view("mapelpengajar.index"); 
    }
    public function pengajar($pengajar_id)
    {
        $pengajar = DB::table('users')
        ->select('name', 'nuptk')
        ->where('id', $pengajar_id)
        ->first();
        $Title = $pengajar->name. " " . $pengajar->nuptk;
        viewShare([
            
            "cardTitle" => $Title,
            "title" =>  "Mepel Pengajar",
            "user_id" => $pengajar_id,
            "mapels" => DB::table('mapel_pengajar')
                            ->join('mapel', 'mapel_pengajar.mapel_id', '=', 'mapel.id')
                            ->join('users', 'users.id', '=', 'mapel_pengajar.user_id')
                            ->select('mapel.*')
                            ->where('mapel_pengajar.user_id', $pengajar_id)
                            ->orderBy('mapel.muatan', 'asc')
                            ->orderBy('mapel.fase', 'asc')
                            ->get()
        ]);
        return response()->view("mapelpengajar.detail");        
    }

    public function create($user_id) //formnya
    {
        viewShare([
            "title" => "Create Mapel",
            "userId" => $user_id,
            "mapels" => DB::table('mapel')
                        ->join('jurusan', 'mapel.jurusan_id', '=', 'jurusan.id')
                        ->select('mapel.*', 'jurusan.nama_jurusan')
                        ->orderBy('jurusan.nama_jurusan', 'asc')
                        ->orderBy('mapel.nama_mapel', 'asc')
                        ->orderBy('mapel.fase', 'asc')
                        ->get()
        ]);
        return response()->view("mapelpengajar.create");
    }

    public function store($user_id)
    {
        $data = request()->validate([
            'mapel_id' => 'required',
             
        ]);
        $data['user_id'] = $user_id; 
        MapelPengajar::create($data);
        return redirect()->route("pengajar.pengajar", $user_id)->with("success", "Berhasil menambahkan data mapel");
    }

    public function destroy($mapel_id, $user_id)
    {
        $mapel = MapelPengajar::where('mapel_id', $mapel_id)->where('user_id', $user_id)->first();
        if (!$mapel) {
            return redirect()->route("mapelpengajar.index", $user_id)->with("error", "Data mapel tidak ditemukan");
        }
    
        if ($mapel->delete()) {
            return redirect()->route("pengajar.pengajar", $user_id)->with("success", "Data mapel berhasil dihapus");
        } else {
            return redirect()->route("pengajar.pengajar", $user_id)->with("error", "Gagal menghapus data mapel");
        }
    }
    
}
