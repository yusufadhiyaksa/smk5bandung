<x-dashboard.layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Edit</h5>
                        <form id="mapel.update" action="{{route('mapel.update', ['jurusanId' => request()->route('jurusanId'), 'id' => $mapels->first()->id])}}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row g-4">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="name" class="form-label">Nama Mapel</label>
                                        <input type="text" id="name" class="form-control"
                                               placeholder="Nama mapel" name="nama_mapel" value="{{ $mapels->first()->nama_mapel }}">
                                    </div>
                                </div>

                               <input type="hidden" name="jurusan_id" value="{{request()->route('jurusanId')}}">

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="fase" class="form-label">Fase</label>
                                        <select name="fase" class="form-control">
                                            <option value="{{ $mapels->first()->fase }}">{{ $mapels->first()->fase }}</option>
                                            <option value="E">E</option>
                                            <option value="F">F</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="muatan" class="form-label">Muatan</label>
                                        <select name="muatan" class="form-control">
                                            <option value="{{ $mapels->first()->muatan }}">{{ $mapels->first()->muatan }}</option>
                                            <option value="nasional">Nasional</option>
                                            <option value="kewilayahan">Kewilayahan</option>
                                            <option value="peminatan kejuruan">Peminatan Kejuruan</option>
                                            <option value="kompetensi keahlian">Kompetensi Keahlian</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="co-12">
                                    <div class="form-group">
                                        <label for="capaian_mapel" class="form-label">Capaian Pembelajaran</label>
                                        <textarea class="form-control"  style="height:8rem;" name="capaian_mapel" placeholder="Masukkan capaian pembelajaran" id="capaian_mapel">{{ $mapels->first()->capaian_mapel }}</textarea>  
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <x-atoms.button-back :url="route('mapel.index', request()->route('jurusanId'))" />
                        <x-atoms.button-save form="mapel.update" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard.layout>
