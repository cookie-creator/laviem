@extends('layouts.app')

@section('content')
    @include('users.crumbs')
    @include('users.form')
    <div class="row">
        <div class="col-12 col-md-8">
            <div class="px-3 mb-5">
                <h3>{{ $user->name }}</h3>
                @yield('user-form')
            </div>

            @if($notifications)
                <div class="px-3 mb-3">

                    <div class="row pb-2">
                        <div class="col-6">
                            <h5>Notifications</h5>
                        </div>

                        <div class="col-6 col-md-6">
                            <form  method="POST" action="{{ route('notification.private.create', ['user_id' => $user->id]) }}" class="needs-validation" novalidate="">
                                @csrf
                                <button class="btn w-50 btn-success btn-sm float-right" type="submit">+ Create private</button>
                            </form>
                        </div>
                    </div>

                    <div class="list-group">

                        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                            <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                            </symbol>
                            <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                            </symbol>
                            <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                            </symbol>
                        </svg>

                        @foreach($notifications as $item)

                            <a href="{{ route('notification.show', ['notification_id' => $item->admin_notification_id]) }}" class="d-flex text-muted pt-3 rounded border-1 px-3 mb-2 text-decoration-none">

                                @if ($item->type == 1)
                                    <div class="alert alert-success d-flex align-items-center p-1 me-3 h-25" role="alert">
                                        <svg class="bi flex-shrink-0" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                                    </div>
                                @elseif($item->type == 2)
                                    <div class="alert alert-warning d-flex align-items-center p-1 me-3 h-25" role="alert">
                                        <svg class="bi flex-shrink-0" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                                    </div>
                                @elseif($item->type == 3)
                                    <div class="alert alert-danger d-flex align-items-center p-1 me-3 h-25" role="alert">
                                        <svg class="bi flex-shrink-0" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                                    </div>
                                @else
                                    <div class="alert alert-info d-flex align-items-center p-1 me-3 h-25" role="alert">
                                        <svg class="bi flex-shrink-0" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>
                                    </div>
                                @endif

                                <div class="pb-3 mb-0 small lh-sm w-100">
                                    <div class="d-flex justify-content-between">
                                        <strong class="text-gray-dark">{{ $item->title }}</strong>
                                        <small class="opacity-50 text-nowrap">{{ $item->created_at }}</small>
                                    </div>
                                    @if ($item->private == 1)
                                        <p class="text-warning py-0 my-0 mb-1"><strong>Is private</strong></p>
                                    @endif

                                    @if ($item->status == 0)

                                    @elseif ($item->status == 1)
                                        <p class="text-danger py-0 my-0 mb-1">Process sending in progress</p>
                                    @elseif ($item->status == 2)
                                        <p class="text-success py-0 my-0 mb-1">Notification was sent</p>
                                    @endif

                                    <span class="d-block">{{ $item->message }}</span>
                                </div>
                            </a>

                        @endforeach
                    </div>
                </div>
            @else
                <p><span>No notifications yet.</span></p>
            @endif

            @if($bookmarks)
                <div class="px-3 mb-5 pt-4">
                    <div class="row">
                        <div class="col-6">
                            <h5>Bookmarks</h5>
                        </div>

                        <div class="col-6 pb-2">
                            <a class="text-white btn btn-success btn-sm float-right" href="{{ url("/user/{$user->id}/bookmark-create") }}">
                                + Create new
                            </a>
                        </div>
                    </div>
                    <div class="mb-3">
                        @foreach($bookmarks as $item)

                            <div class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
                                <div class="d-flex gap-2 w-100 justify-content-between">
                                    <div>
                                        <h6 class="mb-0">
                                            <a href="{{ url("/user/{$user->id}/bookmark/{$item->id}") }}">{{ $item->name }}</a>
                                            @if($item->category)
                                                <span>/{{ $item->category->name }}</span>
                                            @endif
                                        </h6>
                                        @if ($item->details)
                                            <p class="mb-0 opacity-75">{{ $item->details->description }}</p>
                                        @endif
                                        <p class="mb-0 opacity-75">
                                            <a href="{{ url("/user/{$user->id}/bookmark/{$item->id}/delete") }}" class="link-danger">delete</a>
                                        </p>
                                    </div>
                                    <small class="opacity-50 text-nowrap">{{ $item->updated_at }}</small>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{$bookmarks->links()}}

                </div>
            @else
                <p><span>No bookmarks yet.</span></p>
            @endif

        </div>

        <div class="col-12 col-md-4">
            <div class="px-3 mb-5">

                <div class="row">
                    <div class="col-6">
                        <h5>Categories</h5>
                    </div>

                    <div class="col-6 pb-2">
                        <a class="text-white btn btn-success btn-sm float-right" href="{{ url("/user/{$user->id}/category-add") }}">
                            + Add
                        </a>
                    </div>
                </div>

                @if($categories)
                    @foreach($categories as $item)

                        <div class="list-group-item list-group-item-action d-flex gap-2 py-2" aria-current="true">
                            <div class="d-flex gap-2 w-100 justify-content-between">
                                <div>
                                    <h6 class="mb-0"><a href="{{ url("/user/{$user->id}/category/{$item->id}") }}">{{ $item->name }}</a></h6>
                                </div>
                                <small class="opacity-50 text-nowrap">{{ $item->updated_at }}</small>
                            </div>
                        </div>

                    @endforeach
                @else
                    <p><span>No categories yet.</span></p>
                @endif
            </div>
        </div>



    </div>
@endsection
