@extends('layouts.app')

@section('content')
    @include('bookmark.crumbs')
    @include('bookmark.form')

    <div class="row">
        <div class="col-12 col-md-6">
            <div class="px-3 mb-5">
                <h3>{{ $bookmark->name }}</h3>

                @yield('bookmark-form')

            </div>
        </div>
    </div>


@endsection
