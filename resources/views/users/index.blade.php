@extends('layouts.app')

@section('content')
    <div class="container pt-4 pb-5">

        <div class="row">
            <div class="col-6">
                <h5 class="text-gray-700">List of all users</h5>
            </div>

            <div class="col-6 pb-2">
                <a class="text-white btn btn-success btn-sm float-right" href="{{ url("/user/create") }}">
                    + Create new
                </a>
            </div>

        </div>

        <div class="">
            <div class="col-12">
                @if($users)
                    <table class="table table-striped table-hover table-sm table-responsive">
                        <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody class="">
                        @foreach($users as $user)
                            <tr>
                                <th scope="row" class="text-sm text-black-50"><span>{{ $loop->iteration }}</span></th>
                                <td class="text-sm">
                                    <span>
                                    <a href="{{ route('user.show', ['user_id' => $user->id]) }}">
                                        {{ $user->name }}
                                    </a>
                                    </span>
                                </td>
                                <td class="text-sm">
                                    <span>
                                        {{ $user->email }}
                                    </span>
                                </td>
                                <td class="text-sm">
                                    <span class="text-gray-600">
                                        {{ $user->created_at }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    {{$users->links()}}

                @else
                    <p><span>No users yet.</span></p>
                @endif
            </div>
        </div>
    </div>

@endsection
