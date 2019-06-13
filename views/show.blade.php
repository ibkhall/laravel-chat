
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
                <div class="card-header">{{ $user->name }}</div>
                <div class="card-body conversations">
                    @if($messages->hasMorePages())
                        <div class="text-center">
                            <a href="{{ $messages->nextPageUrl() }}" class="btn btn-light">
                                Voi les messages précédents
                            </a>
                        </div>
                    @endif
                    @foreach(array_reverse($messages->items()) as $message)
                        <div class="row">
                            <div class="col-md-10 {{ $message->from->id !== $user->id ? 'offset-md-2 text-right' : '' }}">
                                <p>
                                    <strong>{{ $message->from->id !== $user->id ? 'Moi' : $message->from->name }}</strong><br>
                                    {!! nl2br(e($message->content)) !!}
                                </p>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                    @if($messages->previousPageUrl())
                        <div class="text-center">
                            <a href="{{ $messages->previousPageUrl() }}" class="btn btn-light">
                                Voi les messages suivants
                            </a>
                        </div>
                    @endif
                    <form action="" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <textarea name="content" class="form-control {{ $errors->has('content') ? 'is-invalid' : '' }}" placeholder="Ecrivez otre message"></textarea>
                            @if($errors->has('content'))
                                <div class="invalid-feedback">{{ implode(', ',$errors->get('content')) }}</div>
                            @endif
                        </div>
                        <button class="btn btn-primary" type="submit">Envoyer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
