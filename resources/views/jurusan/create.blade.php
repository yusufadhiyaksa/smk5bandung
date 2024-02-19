<x-dashboard.layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Tambah Jurusan</h5> 
                        <form id="jurusan.store" action="{{route('jurusan.store')}}" method="POST">
                            @csrf
                            <div class="row g-4">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="name" class="form-label">Nama Jurusan</label>
                                        <input type="text" id="name" class="form-control"
                                               placeholder="Nama Jurusan" name="nama_jurusan">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <x-atoms.button-back :url="route('jurusan.index')" />
                        <x-atoms.button-save form="jurusan.store" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard.layout>

