<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Mapel;

class MapelController extends Controller
{
    public function index($jurusanId) //show collection of data
    {
        viewShare([
            "cardTitle" => "Mapel",
            "title" => "Mapel",
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

    public function edit() //formnya
    {

    }

    public function store($jurusanId)
    {
        Mapel::create(request()->post());

        return redirect()->route("mapel.index", $jurusanId)->with("success", "Berhasil menambahkan data mapel");
    }

    public function update()
    {

    }

    public function destroy() //proses hapus
    {

    }
}
