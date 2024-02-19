<x-dashboard.layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Tambah Kelas Baru</h5>
                        <form id="kelas.store" action="{{route('kelas.store', request()->route('jurusanId'))}}" method="POST">
                            @csrf
                            <div class="row g-4">
                                <input type="hidden" name="jurusan_id" value="{{request()->route('jurusanId')}}">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="tingkat" class="form-label">Tingkat</label>
                                        <select name="tingkat" class="form-control">
                                            <option value="10" selected>10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                            <option value="13">13</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="name" class="form-label">Nama Kelas</label>
                                        <input type="text" id="name" class="form-control"
                                               placeholder="Nama Kelas" name="nama_kelas">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="jumlah" class="form-label" required>Jumlah Siswa</label>
                                        <input type="number" id="name" class="form-control"
                                               placeholder="Jumlah Siswa" name="jumlah_siswa">
                                    </div>
                                </div>     
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="pengajar" class="form-label">Wali Kelas</label>
                                        <select name="pengajar_id" class="form-control">
                                            @foreach ($users as $user)
                                                <option value="{{ $user['id'] }}">{{ $user['name'] }}</option>
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
                        <x-atoms.button-back :url="route('kelas.index', request()->route('jurusanId'))" />
                        <x-atoms.button-save form="kelas.store" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard.layout>
