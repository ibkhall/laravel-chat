
@section('content')
    <h3 class="text-center text-primary">Chat</h3>
    <div class="row">
        <div class="col-md-3">
            <div class="list-group">
                @foreach($users as $user)
                    <a href="{{ route('chat.show', $user) }}" class="list-group-item list-group-item-action">
                        {{ $user->name }}
                        @if(isset($unread[$user->id]))
                            <span class="badge float-sm-none text-white badge-success badge-sm badge-pill">{{ $unread[$user->id] }}</span>
                        @endif
                    </a>
                @endforeach
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <h3 class="text-center text-success">start chat !</h3>
            </div>
        </div>
    </div>


@endsection
