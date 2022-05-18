@extends('layouts.app')

@section('content')

    @include('users.crumbs')
    @include('users.form')

    <div class="row">
        <div class="col-12 col-md-6 col-sm-8">
            <div class="px-3 mb-5">
                <h3>{{ $user->name }}</h3>
                @yield('user-form')
            </div>
        </div>
    </div>

@endsection
