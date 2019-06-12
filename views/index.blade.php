@section('content')
<div class="card-outline-info">
    <div class="card-body">
        <h3 class="">Messagerie</h3>
        <p>&nbsp;</p>
        <div class="chat-main-box b-t">
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
                        <h3 class="box-title text-center">Chat</h3>
                    </div>
                </div>
                <div class="chat-rbox">
                    <ul class="chat-list p-20">

                    <!--chat Row -->
                    </ul>
                </div>
                <div class="card-body b-t">

                </div>
            </div>
        </div>
        <!-- /.chat-row -->
    </div>
</div>


@endsection
