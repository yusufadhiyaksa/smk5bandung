@php 
    use App\Enums\Role;
    use App\Models\MapelPengajar;
 @endphp

<x-dashboard.layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h5 class="card-title mb-4">{{ $cardTitle }}</h5>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">NUPTK</th>
                                    <th scope="col">Telepon</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">Jumlah Mapel </th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->nuptk }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>{{ $user->address }}</td>
                                    <td>{{ MapelPengajar::where('user_id',$user->id)->count(); }}</td>
                                    <td>
                                        <div class="d-flex"> 
                                            <a href="{{ route('pengajar.pengajar', ['pengajar_id' => $user->id]) }}" class="btn btn-sm btn-info icon icon-left">Detail</a>
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


