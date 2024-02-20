@php use App\Enums\Role; @endphp
<x-dashboard.layout>
    <div class="row">
        <div class="col-12"> 
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h5 class="card-title mb-4">{{ $cardTitle }}</h5>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <x-atoms.button-create :url="route('materi.create')" />
                        </div>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Judul Materi</th>
                                <th scope="col">Pembuat</th>
                                <th scope="col">Mata Pelajaran</th>
                                <th scope="col">Dibuat Tanggal</th>
                                <th scope="col">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($materis as $key => $materi)
                                <tr>
                                    <th scope="row">{{ $key+1 }}</th>
                                    <td>{{ $materi->judul_materi }}</td>
                                    <td>{{ $materi->pembuat_materi }}</td>
                                    <td>{{ $materi->nama_mapel}}</td>
                                    <td>{{ $materi->created_at }}</td>
                                    <td>
                                        <div class="d-flex">   
                                            <x-atoms.button-edit :url="route('materi.edit', ['id' => $materi->id])" />
                                            <form id="delete-form-{{ $materi->id }}" action="{{ route('materi.destroy', ['id' => $materi->id]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <x-atoms.button-destroy :url="route('materi.destroy', ['id' => $materi->id])" />
                                            </form>
                                        </div>
                                      
                                    </td>
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
