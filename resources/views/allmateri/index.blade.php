@php use App\Enums\Role; @endphp
<x-dashboard.layout>
    <div class="row">
        <div class="col-12"> 
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h5 class="card-title mb-4">{{ $cardTitle }}</h5>

                        <div class="row row-cols-1 row-cols-md-4 g-4 py-5">
                            @foreach ($materis as $materi)
                            <div class="col">
                                <div class="card shadow ">
                                    <div class="card-content">
                                        <img class="card-img-top img-fluid" src="{{ asset('storage/' . $materi->cover_foto) }}"
                                            alt="Card image cap" style="height: 15rem" />
                                        <div class="card-body" >
                                            <h6 class="card-title" style="min-height: 4rem; ">{{ Str::limit($materi->judul_materi, 55) }}</h6>
                                            <p class="card-text ">
                                                {{ Str::limit($materi->deskripsi_materi, 50) }}
                                            </p>
                                            <div class="d-flex justify-content-end"> 
                                                <a href="{{ route('allmateri.show', $materi->id) }}" class="btn btn-primary">Detail</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard.layout>
