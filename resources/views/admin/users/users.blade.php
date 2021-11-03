@extends("layouts.app")

@section("content")
    <div class="wrapper">
        <h2>Users:</h2>
        <div class="d-flex flex-row">
            @foreach($users as $user)
                <div class="category">
                    <h4>{{ $user["name"] }}</h4>
                    @if($user->super)
                        <a href="{{ route("user.admin", [$user, 0]) }}" class="edit">Remove admin</a>
                    @else
                        <a href="{{ route("user.admin", [$user, 1]) }}" class="edit">Make admin</a>
                    @endif
                    <a href="{{ route("user.delete", $user) }}" class="delete">Delete</a>
                </div>
            @endforeach

        </div>
    </div>
@endsection
