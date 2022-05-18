@extends('layouts.app')

@section('content')

    <h3 class="pb-3 pt-3 px-3">Notifications</h3>
    <div class="row pb-2">

        <div class="col-12 col-md-6">
            <div class="px-3">
                <a class="text-white btn btn-success btn-sm float-left" href="{{ route('notification.create') }}">
                    + Create new
                </a>
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="px-3">
                <h5>Personal notifications</h5>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-12 col-md-6">
            <div class="px-3 mb-5">

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

                    @isset($notifications)

                        @foreach($notifications as $item)

                            <a href="{{ route('notification.show', ['notification_id' => $item->id]) }}" class="d-flex text-muted pt-3 rounded border-1 px-3 mb-2 text-decoration-none">

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

                        {{$notifications->links()}}
                    @endisset
                </div>

            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="px-3 mb-5">

                @isset($privateNotifications)
                    @foreach($privateNotifications as $item)

                        <a href="{{ route('notification.show', ['notification_id' => $item->id]) }}" class="d-flex text-muted pt-3 rounded border-1 px-3 mb-2 text-decoration-none">

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

                @endisset
            </div>
        </div>

    </div>

@endsection

