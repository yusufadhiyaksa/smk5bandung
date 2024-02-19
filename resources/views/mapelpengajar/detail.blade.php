@php use App\Enums\Role; @endphp
<x-dashboard.layout>
    <div class="row">
        <div class="col-12"> 
            <div class="card">
                
                <div class="card-content">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="card-title">{{ $cardTitle }}</h5>
                            <div>
                                <x-atoms.button-back :url="route('pengajar.index')" class="me-2 btn-lg"/>
                                <x-atoms.button-create :url="route('pengajar.create', ['user_id' => $user_id])" />
                            </div>
                        </div>
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Mapel</th>
                                    <th scope="col">Fase</th>
                                    <th scope="col">Muatan</th>
                                    <th scope="col">Dibuat Tanggal</th>
                                    <th scope="col">Aksi</th>
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
                                        <td>
                                            <div class="d-flex">                                               
                                                <form id="delete-form-{{ $mapel->id }}" action="{{ route('pengajar.destroy', ['mapel_id' => $mapel->id, 'user_id' => $user_id]) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <x-atoms.button-destroy :url="route('pengajar.destroy', ['mapel_id' => $mapel->id, 'user_id' => $user_id])" />
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
    </div>
</x-dashboard.layout>
