@php use App\Enums\Role; @endphp
<x-dashboard.layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h5 class="card-title mb-4">{{ $cardTitle }}</h5>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <x-atoms.button-create :url="route('mapel.create', request()->route('jurusanId'))" />
                        </div>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Mapel</th>
                                <th scope="col">Fase</th>
                                <th scope="col">Muatan</th>
                                <th scope="col">Dibuat Tanggal</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($mapels as $key => $mapel)
                                <tr>
                                    <th scope="row">{{ $key+1 }}</th>
                                    <td>{{ $mapel->nama_mapel }}</td>
                                    <td>{{ $mapel->fase }}</td>
                                    <td>{{ $mapel->muatan }}</td>
                                    <td>{{ $mapel->created_at }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard.layout>
