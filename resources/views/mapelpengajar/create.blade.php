<x-dashboard.layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Tambah Mapel Baru</h5>

                        <form id="pengajar.store" action="{{route('pengajar.store', ['user_id' => $userId])}}" method="POST">

                            @csrf
                            <div class="row g-4">         
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="mapel_id" class="form-label">Mapel</label>
                                        <select name="mapel_id" class="form-control">
                                            @foreach ($mapels as $mapel )
                                            <option value="{{$mapel->id}}">{{ $mapel->nama_jurusan }} - {{$mapel->nama_mapel}} - Fase {{$mapel->fase}} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <x-atoms.button-back :url="route('pengajar.pengajar', ['pengajar_id' => $userId])" />
                        <x-atoms.button-save form="pengajar.store" />
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard.layout>
