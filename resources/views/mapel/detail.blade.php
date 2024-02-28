@php use App\Enums\Role; @endphp
<x-dashboard.layout>
    <div class="row">
        <div class="col border"> 
            <div class="card mb-3">
                <div class="card-content">
                    <div class="card-body">
                        <div class="row"> 
                            <div class="col">
                                <h5>{{ $mapels->first()->nama_mapel }} Fase {{ $mapels->first()->fase }}</h5>
                                <p>Muatan: {{ $mapels->first()->muatan }}</p>
                            </div>
                            <div class="col">
                                <div class="gap-2 d-md-flex justify-content-md-end">
                                    <x-atoms.button-edit :url="route('mapel.edit', ['jurusanId' => request()->route('jurusanId'), 'id' => $mapels->first()->id])" />
                                    <form id="delete-form-{{ $mapels->first()->id }}" action="{{ route('mapel.destroy', ['jurusanId' => request()->route('jurusanId'), 'id' => $mapels->first()->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <x-atoms.button-destroy :url="route('mapel.destroy', ['jurusanId' => request()->route('jurusanId'), 'id' => $mapels->first()->id])" />
                                    </form>		
                                </div>
                            </div>                            
                        </div>
                        <div class="col shadow border p-2" style="height: 10rem;">
                            <h6>Capaian Pembelajaran</h6>
                            <p>{{ $mapels->first()->capaian_mapel }}</p>  
                        </div>                  
                    </div>                    
                </div>
            </div>
            <div class="card">
                <div class="card-content">
                    <div class="card-body">  
                        <div class="col"> 
                                <h5>Capaian Pembelajaran Pada Setiap Elemen</h5>               
                        </div>
                        <div class="col  p-2">
                            <table class="table table-bordered shadow">
                                <thead>
                                <tr>
                                    <th scope="col" style="width: 25%;">Elemen</th>
                                    <th scope="col">Capaian</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($elemens as $elemen)
                                    <tr>
                                        <th scope="row">{{ $elemen->elemen }}</th>
                                        <td class="p-0">
                                            <table class="table table-bordered mb-0">
                                                @foreach ($capaians as $capaian )
                                                @if ($capaian->elemen_id == $elemen->id)
                                                    <tr><td > {{ $capaian->capaian }}</td></tr>
                                                @endif    
                                                @endforeach                                                 
                                                <tr>
                                                    <td class="text-center">
                                                        <a href="#" class="button btn-lg ">Capaian <i class="bi bi-plus-circle-fill"></i></a>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    @endforeach
                                    <tr class="text-center">
                                        <td>
                                            <a class="button btn-lg ">Elemen <i class="bi bi-plus-circle-fill" data-bs-toggle="modal" data-bs-target="#exampleModal"></i> </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>               
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-dashboard.layout>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
