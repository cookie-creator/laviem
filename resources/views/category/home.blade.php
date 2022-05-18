@extends('layouts.app')

@section('content')
    @include('category.crumbs')
    @include('category.form')

    <div class="row">
        <div class="col-12 col-md-6">
            <div class="px-3 mb-5">
                <h3>{{ $category->name }}</h3>

                @yield('category-form')
            </div>
        </div>
    </div>


@endsection
