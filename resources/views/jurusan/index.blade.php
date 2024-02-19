@php use App\Enums\Role; @endphp
<x-dashboard.layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h5 class="card-title mb-4">{{ $cardTitle }}</h5>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <x-atoms.button-create :url="route('jurusan.create')" />
                        </div>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Jurusan</th>
                                <th scope="col">Last Updated</th>
                                <th scope="col">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($jurusans as $key => $jurusan)
                                <tr>
                                    <th scope="row">{{ $key+1 }}</th>
                                    <td>{{ $jurusan->nama_jurusan }}</td>
                                    <td>{{ $jurusan->updated_at }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <x-atoms.button-edit :url="route('jurusan.edit', ['jurusanId' => $jurusan->id])" />
                                            <form id="delete-form-{{ $jurusan->id }}" action="{{ route('jurusan.destroy', ['jurusanId' => $jurusan->id]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <x-atoms.button-destroy :url="route('jurusan.destroy', ['jurusanId' => $jurusan->id])" />
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

