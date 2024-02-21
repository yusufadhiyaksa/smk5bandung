<x-dashboard.layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Tambah Materi Baru</h5>
                        
                        <form id="materi.store" action="{{route('materi.store')}}" enctype="multipart/form-data" method="POST">
                            @csrf
                            
                            <div class="row g-4">
                                <input type="hidden" name="user_id" value="{{$userId}}">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="mapel" class="form-label">Mapel</label>
                                        <select name="mapel" class="form-control">
                                            <option value="">Pilih Mapel</option>
                                            @foreach ($mapels as $mapel)
                                                <option value="{{ $mapel->id }}">{{ $mapel->nama_mapel }}</option>
                                            @endforeach
                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="judul_materi" class="form-label">Judul materi</label>
                                        <input type="text" id="judul_materi" class="form-control"
                                               placeholder="Judul Materi" name="judul_materi">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="pembuat_materi" class="form-label">Pembuat materi</label>
                                        <input type="text" id="pembuat_materi" class="form-control"
                                               placeholder="Nama Pembuat" name="pembuat_materi">
                                    </div>
                                </div>
                                <div class="co-12">
                                    <div class="form-group">
                                        <label for="deskripsi_materi" class="form-label">Desrkipsi materi</label>
                                        <textarea class="form-control" name="deskripsi_materi" placeholder="Deskripsikan isi dari materi yang disimpan" id="deskripsi_materi"></textarea>  
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="link_materi" class="form-label">Link Materi</label>
                                        <input type="text" id="link_materi" class="form-control"
                                               placeholder="Masukkan Link Disini" name="link_materi">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="formFile" class="form-label">Cover Materi</label>
                                        <input class="form-control mb-3" type="file" id="formFile" name="cover_foto" onchange="previewImage()">
                                        <img id="img-preview" class="img-preview img-fluid" style="max-height: 15rem;">
                                    </div>
                                </div>                                
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <x-atoms.button-back :url="route('materi.index')" />
                        <x-atoms.button-save form="materi.store" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard.layout>
<script>
    function previewImage() {
        const image = document.querySelector('#formFile');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';
        
        const oFReader = new FileReader();
        oFReader.onload = function (oFREvent) {
            imgPreview.src = oFREvent.target.result;
        };
        oFReader.readAsDataURL(image.files[0]);
    }
</script>

