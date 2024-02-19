@php use App\Enums\Role; @endphp
<x-dashboard.layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h5 class="card-title mb-4">{{ $cardTitle }}</h5>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <x-atoms.button-create :url="route('kelas.create', request()->route('jurusanId'))" />
                        </div>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Tingkat</th>
                                <th scope="col">Kelas</th>
                                <th scope="col">Wali Kelas</th>
                                <th scope="col">Jumlah Siswa</th>
                                <th scope="col">Last Updated</th>
                                <th scope="col">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($kelass as $key => $kelas)
                                <tr>
                                    <th scope="row">{{ $key+1 }}</th>
                                    <td>{{ $kelas->tingkat }}</td>
                                    <td>{{ $kelas->nama_kelas }}</td>
                                    <td>{{ $kelas->nama_pengajar }}</td>
                                    <td>{{ $kelas->jumlah_siswa }}</td>
                                    <td>{{ $kelas->updated_at }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <x-atoms.button-edit :url="route('kelas.edit', ['jurusanId' => request()->route('jurusanId'), 'id' => $kelas->id])" />
                                            <form id="delete-form-{{ $kelas->id }}" action="{{ route('kelas.destroy', ['jurusanId' => request()->route('jurusanId'), 'id' => $kelas->id]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <x-atoms.button-destroy :url="route('kelas.destroy', ['jurusanId' => request()->route('jurusanId'), 'id' => $kelas->id])" />
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
