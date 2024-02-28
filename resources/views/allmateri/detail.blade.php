@php use App\Enums\Role; @endphp
<x-dashboard.layout>
    <div class="row">
        <div class="col-12"> 
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="row" ">
                            <div class="col-md-4">
                                <h5 class="card-title">{{ $materis->first()->judul_materi}}</h5>
                                <p>Karya: {{ $materis->first()->pembuat_materi }}</p>   
                            </div>
                            <div class="col-md-8  d-md-flex justify-content-md-end">
                                    <p>{{ $materis->first()->name }}</p>
                            </div>
                        </div>
                        <div class="row" ">
                            <div class="col-md-4">
                                <img class="rounded" src="{{ asset('storage/' . $materis->first()->cover_foto) }}" alt="Card image cap" style="width:100%;" />
                            </div>
                            <div class="col-md-8">
                                    <p>{{ $materis->first()->deskripsi_materi }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ $materis->first()->link_materi }}" class="btn btn-sm btn-primary me-3">Full Text</a>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</x-dashboard.layout>
