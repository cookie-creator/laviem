@extends('layouts.app')

@section('content')

    <h3 class="pb-3 pt-3 px-3">Notification</h3>
    <div class="row pb-2 px-3 mb-5">

        <h5 class="pb-1 px-2 text-sm text-black-50">You can edit notification this notification</h5>

        <div class="col-6 col-md-6">
            <form  method="POST" action="{{ route('notification.private.update', ['notification_id' => $notification->id]) }}" class="needs-validation" novalidate="">
                @csrf
                <input type="hidden" class="form-control" id="private" name="private" value="{{ $notification->private }}" placeholder="" required="">
                @if ($notification->private !== 0)
                    <div class="alert alert-success d-flex align-items-center px-2 py-2" role="alert">
                        Notification is private for&nbsp;<a href="{{ route('user.show', ['user_id' => $user->id]) }}">{{ $user->name }}</a>
                    </div>
                @endif

                <div class="col-12">
                </div>

                <div class="col-12">
                    <label for="name" class="form-label">Notification type</label>
                </div>

                <div class="col-12 mb-3 ">
                    <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                        <input type="radio"
                               @if ($notification->type == 0) checked="checked" @endif
                               class="btn-check" name="type" id="btnradio1" value="0" autocomplete="off">
                        <label class="btn btn-sm btn-outline-info" for="btnradio1">Default</label>

                        <input type="radio"
                               @if ($notification->type == 1) checked="checked" @endif
                               class="btn-check" name="type" id="btnradio2" value="1" autocomplete="off">
                        <label class="btn btn-sm btn-outline-success" for="btnradio2">Success</label>

                        <input type="radio"
                               @if ($notification->type == 2) checked="checked" @endif
                               class="btn-check" name="type" id="btnradio3" value="2" autocomplete="off">
                        <label class="btn btn-sm btn-outline-warning" for="btnradio3">Information</label>

                        <input type="radio"
                               @if ($notification->type == 3) checked="checked" @endif
                               class="btn-check" name="type" id="btnradio4" value="3" autocomplete="off">
                        <label class="btn btn-sm bg-gray-100 btn-outline-danger" for="btnradio4">Important</label>
                    </div>
                </div>

                <div class="col-12 mb-3 ">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $notification->title }}" placeholder="" required="">
                </div>

                <div class="col-12 mb-3">
                    <label for="message" class="form-label">Message</label>
                    <textarea class="form-control" id="message" name="message" rows="3">{{ $notification->message }}</textarea>
                </div>

                <div class="row">
                    <div class="col-6">
                        <button class="btn w-50 btn-primary btn-sm" type="submit">Update</button>
                    </div>
                    <div class="col-6">
                        <a class="text-white w-50 btn btn-secondary btn-sm float-right" href="{{ route('notifications') }}">
                            Cancel
                        </a>
                    </div>
                </div>

            </form>

        </div>

        <div class="col-6 col-md-6">
            <form  method="POST" action="{{ route('notification.private.destroy', ['notification_id' => $notification->id]) }}" class="needs-validation" novalidate="">
                @csrf
                <div class="col-6">
                    <button class="btn w-50 btn-danger btn-sm" type="submit">Delete</button>
                </div>
            </form>
        </div>

    </div>

@endsection
