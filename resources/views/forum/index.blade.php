@php use App\Enums\Role; @endphp
<x-dashboard.layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h5 class="card-title mb-4">{{ $cardTitle }}</h5>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <x-atoms.button-create :url="route('forum.create')" />
                        </div>
                        @foreach ($forums as $forum)
                        <div class="row mt-4 border shadow" >
                            <div class="col-3   text-center mt-4 mb-2">
                                <div class="pr-50">
                                    <div class="avatar avatar-2xl mt-4 shadow">
                                        <img src="{{ asset('storage/' . $forum->profile_image) }}" alt="Avatar">    
                                    </div>
                                    <div class="comment-profileName mt-4">{{ $forum->name }} </div>
                                </div>
                            </div>
                            <div class="col  mt-4 mb-2">
                                <div class="row-1  d-md-flex ">
                                    <div class="col "><h5>{{ $forum->judul}}</h5></div>
                                    <div class="col-3  d-md-flex justify-content-md-end comment-time" >{{ $forum->created_at }}</div>
                                </div>
                                <div class="row-1 mt-4 border shadow comment-message" style="height:8rem;">
                                    <p class="list-group-item-text truncate mb-18 ms-2 mt-1">{{ $forum->konten }}</p>
                                </div>
                                <div class="comment-actions row-1 mt-4 mb-2  d-md-flex justify-content-md-end">
                                    <button class="btn icon icon-left btn-primary me-2 text-nowrap"><i class="bi bi-eye-fill"></i> Show</button>
                                    @if ($forum->user_id==Auth::user()->id)
                                    <a href="{{ route('forum.edit', ['id' => $forum->id]) }}" class="btn icon icon-left btn-warning me-2 text-nowrap"><i class="bi bi-pencil-square"></i> Edit</a>
                                    <form id="delete-form-{{ $forum->id }}" action="{{ route('forum.destroy', ['id' => $forum->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                        <x-atoms.button-destroy :url="route('forum.destroy', [ 'id' => $forum->id])" />
                                    </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach   
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard.layout>

