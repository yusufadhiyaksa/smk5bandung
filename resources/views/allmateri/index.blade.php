@php use App\Enums\Role; @endphp
<x-dashboard.layout>
    <div class="row">
        <div class="col-12"> 
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h5 class="card-title mb-4">{{ $cardTitle }}</h5>
                        <form action="{{ route('allmateri.show') }}" method="GET" class="mb-3">
                            <div class="input-group">
                                <input type="text" name="keyword" class="form-control" placeholder="Cari Materi"">
                                <button type="submit" class="btn btn-primary">Cari</button>
                            </div>
                        </form>

                        <div class="row row-cols-1 row-cols-md-5 g-3 py-2">
                            @foreach ($materis as $materi)
                            <div class="col">
                                <div class="card shadow ">
                                    <div class="card-content">
                                        <img class="card-img-top img-fluid" src="{{ asset('storage/' . $materi->cover_foto) }}"
                                            alt="Card image cap" style="height: 8rem" />
                                        <div class="text-center ms-2 me-2 mt-2 mb-3 " >
                                            <h6 class="card-title" style="height: 2rem; font-size:12px;"><b>{{ Str::limit($materi->judul_materi, 55) }}</b></h6>
                                            <p class="card-text mt-3" style="height: 3rem; font-size:9px;">
                                                {{ Str::limit($materi->deskripsi_materi, 160) }}
                                            </p>
                                            <div class="d-flex justify-content-center mt-4 "> 
                                                <a href="{{ route('allmateri.detail', $materi->id) }}" class="btn btn-sm btn-success">Detail</a>
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
