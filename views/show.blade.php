
@section('content')
    <div class="card-outline-info">
        <div class="card-body">
            <h3 class="">Messagerie</h3>
            <p>&nbsp;</p>
            <div class="chat-main-box b-all">
                <!-- .chat-left-panel -->
                <div class="chat-left-aside bg-light-inverse">
                    <div class="open-panel"><i class="mdi mdi-arrow-right"></i></div>
                    <div class="chat-left-inner">
                        <ul class="chatonline style-none ">
                            @foreach($users as $user)
                                <li>
                                    <a href="{{ route('chat.show', $user) }}">
                                        <img src="{{ $user->avatar ? asset("$user->avatar") : asset('holder.png') }}" alt="user-img" class="img-circle">
                                        <span>
                                    {{ $user->fullName }}
                                            @if(isset($unread[$user->id]))
                                                <span class="badge float-sm-none text-white badge-success badge-sm badge-pill">{{ $unread[$user->id] }}</span>
                                            @endif
                                </span>
                                    </a>
                                </li>
                            @endforeach
                            <li class="p-20"></li>
                        </ul>
                    </div>
                </div>

                <!-- .chat-left-panel -->
                <!-- .chat-right-panel -->
                <div class="chat-right-aside">
                    <div class="chat-main-header">
                        <div class="p-10 b-b">
                            <h3 class="box-title text-center">{{ $user->fullName }}</h3>
                        </div>
                    </div>
                    <div class="chat-rbox">
                        <ul class="chat-list p-20">
                            @if($messages->hasMorePages())
                                <div class="text-center">
                                    <a href="{{ $messages->nextPageUrl() }}" class="btn btn-light">
                                        Voi les messages précédents
                                    </a>
                                </div>
                            @endif
                            <!--chat Row -->
                                @php
                                $auth = Auth::user()
                                @endphp
                            @foreach($messages->reverse() as $message)
                                @if($message->from->id !== $user->id)
                                <li class="reverse b-b">
                                    <div class="chat-time">{{ $message->created_at->format('d/m/Y H:i:s') }}</div>
                                    <div class="chat-content">
                                        <h5>Moi</h5>
                                        <div class="box bg-light-inverse">{!! nl2br($message->content) !!}</div>
                                    </div>
                                    <div class="chat-img"><img src="{{ $auth->avatar ? asset("{$auth->avatar}") : asset('holder.png') }}" alt="user" /></div>
                                    @if($message->read_at) <span class="text-muted text-info"><i class="mdi mdi-check-all"></i></span> @endif
                                </li>
                                @else
                            <!--chat Row -->
                                <li class="b-b">
                                    <div class="chat-img"><img src="{{ $message->from->avatar ? asset("{$message->from->avatar}") : asset('holder.png') }}" alt="user" /></div>
                                    <div class="chat-content">
                                        <h5>{{ $message->from->fullName }}</h5>
                                        <div class="box bg-light-success">{!! nl2br($message->content) !!}</div>
                                    </div>
                                    <div class="chat-time">{{ $message->created_at->format('d/m/Y H:i:s') }}</div>
                                </li>
                                @endif
                            @endforeach
                                @if($messages->previousPageUrl())
                                    <div class="text-center">
                                        <a href="{{ $messages->previousPageUrl() }}" class="btn btn-light">
                                            Voi les messages suivants
                                        </a>
                                    </div>
                                @endif
                            <!--chat Row -->
                        </ul>
                    </div>
                    <div class="card-body b-t">
                        <form action="" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-8">
                                    <div class="form-group">
                                        <label for="">Message</label>
                                        <textarea name="" id="" cols="30" rows="10" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="col-4 text-left">
                                    <button type="submit" class="btn btn-info btn-circle btn-lg text-white"><i class="mdi mdi-send"></i> </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- .chat-right-panel -->
            </div>
            <!-- /.chat-row -->
        </div>
    </div>


@endsection
