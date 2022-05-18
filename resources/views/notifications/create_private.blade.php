@extends('layouts.app')

@section('content')

    <h3 class="pb-3 pt-3 px-3">Create private notification</h3>
    <div class="row pb-2 px-3 mb-5">

        <h5 class="">For user {{ $user->name }}</h5>

        <div class="col-12 col-md-6">
            <form  method="POST" action="{{ route('notification.private.store', ['user_id' => $user->id]) }}" class="needs-validation" novalidate="">
            @csrf
                <input type="hidden" class="form-control" id="private" name="private" value="1" placeholder="" required="">
                <div class="col-12">
                    <label for="name" class="form-label">Notification type</label>
                </div>

                <div class="col-12 mb-3 ">
                    <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                        <input type="radio" class="btn-check" name="type" id="btnradio1" value="0" autocomplete="off">
                        <label class="btn btn-sm btn-outline-info" for="btnradio1">Default</label>

                        <input type="radio" class="btn-check" name="type" id="btnradio2" value="1" autocomplete="off">
                        <label class="btn btn-sm btn-outline-success"for="btnradio2">Success</label>

                        <input type="radio" class="btn-check" name="type" id="btnradio3" value="2" autocomplete="off">
                        <label class="btn btn-sm btn-outline-warning" for="btnradio3">Information</label>

                        <input type="radio" class="btn-check" name="type" id="btnradio4" value="3" autocomplete="off">
                        <label class="btn btn-sm bg-gray-100 btn-outline-danger" for="btnradio4">Important</label>
                    </div>
                </div>

                <div class="col-12 mb-3 ">
                    <label for="name" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="" placeholder="" required="">
                </div>

                <div class="col-12 mb-3">
                    <label for="message" class="form-label">Message</label>
                    <textarea class="form-control" id="message" name="message" rows="3"></textarea>
                </div>

                <div class="row">
                    <div class="col-6">
                        <button class="btn w-50 btn-primary btn-sm" type="submit">Save</button>
                    </div>
                    <div class="col-6">
                        <a class="text-white w-50 btn btn-secondary btn-sm float-right" href="{{ route("user.show", ['user_id' => $user->id]) }}">
                            Cancel
                        </a>
                    </div>
                </div>
            </form>

        </div>

    </div>

@endsection
