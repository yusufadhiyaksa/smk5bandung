<x-dashboard.layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Buat Forum Diskusi</h5> 
                        <form id="forum.store" action="{{route('forum.store')}}" method="POST">
                            @csrf
                            <div class="row g-4">
                                <div class="col-12">
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                    <div class="form-group">
                                        <label for="judul" class="form-label">Judul</label>
                                        <input type="text" id="judul" class="form-control"
                                               placeholder="Judul Forum" name="judul">
                                    </div>
                                </div>
                                <div class="co-12">
                                    <div class="form-group">
                                        <label for="konten" class="form-label" >Konten</label>
                                        <textarea class="form-control" name="konten" style="height: 10rem;" placeholder="Isi konten" id="konten"></textarea>  
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <x-atoms.button-back :url="route('forum.index')" />
                        <x-atoms.button-save form="forum.store" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard.layout>

