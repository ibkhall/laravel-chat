
@section('content')
    <h3 class="text-center text-primary">Laravel Chat</h3>
    <div class="row">
        <div class="col-md-3">
            <div class="list-group">
                @foreach($users as $user)
                    <a href="{{ route('chat.show', $user) }}" class="list-group-item list-group-item-action {{ $user->id == $target->id ? 'active': '' }}">
                        {{ $user->name }}
                        @if(isset($unread[$user->id]))
                            <span class="badge float-sm-none text-white badge-success badge-sm badge-pill">{{ $unread[$user->id] }}</span>
                        @endif
                    </a>
                @endforeach
            </div>
        </div>
        <div class="col-md-9">
            <div class="card card-outline-primary">
                <div class="card-header text-center bg-primary text-white">{{ $target->name }}</div>
                <div class="card-body conversations">
                    @if($messages->hasMorePages())
                        <div class="text-center">
                            <a href="{{ $messages->nextPageUrl() }}" class="btn btn-light">
                                see previous
                            </a>
                        </div>
                    @endif
                    @foreach(array_reverse($messages->items()) as $message)
                        <div class="row">
                            <div class="col-md-10 {{ $message->from->id !== $target->id ? 'offset-md-2 text-right' : '' }}">
                                <p>
                                    <strong>{{ $message->from->id !== $target->id ? 'Me' : $message->from->name }}</strong><span class="text-muted"></span><br>
                                    <span class="badge badge-info text-monospace text-white font-weight-normal py-1 px-2 h1">
                                    {!! nl2br(e($message->content)) !!}

                                    </span>
                                    <br>
                                    <span class="text-muted small">{{ $message->created_at->locale(config('app.locale'))->diffForHumans() }}</span>
                                </p>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                    @if($messages->previousPageUrl())
                        <div class="text-center">
                            <a href="{{ $messages->previousPageUrl() }}" class="btn btn-light">
                                see next
                            </a>
                        </div>
                    @endif
                    <form action="" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <textarea name="content" class="form-control {{ $errors->has('content') ? 'is-invalid' : '' }}" placeholder="Write your message"></textarea>
                            @if($errors->has('content'))
                                <div class="invalid-feedback">{{ implode(', ',$errors->get('content')) }}</div>
                            @endif
                        </div>
                        <button class="btn btn-primary" type="submit">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
