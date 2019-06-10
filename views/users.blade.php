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
