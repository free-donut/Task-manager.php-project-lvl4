@extends('layouts.app')

@section('content')
<div class="container">
    <h3>{{ __('List of users') }}</h3>
    <ul class="list-group mb-2">
        @foreach ($users as $user)
            <li class="list-group-item">{{ $user->name }}</li>
        @endforeach
    </ul>
    {{ $users->links() }}
</div>
@endsection
