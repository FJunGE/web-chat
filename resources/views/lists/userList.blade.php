<div class="list-group">
    {{--<a href="#" class="list-group-item list-group-item-action" style="color: lightgray">
        作者
        <span class="badge badge-primary badge-pill">2</span>
    </a>--}}
    @foreach($users as $user)
        @if($user->status == \App\Models\User::USER_STATUS_OFFLINE)
            <a href="#" class="list-group-item list-group-item-action" style="color: lightgray">{{ $user->name }}</a>
        @else
            <a href="#" class="list-group-item list-group-item-action">{{ $user->name }}</a>
        @endif
    @endforeach
</div>