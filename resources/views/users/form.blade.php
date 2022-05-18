@section('user-form')
    <form  method="POST"
           @if ($user->id)
            action="/user/{{ $user->id }}/update"
           @else
            action="/user/store"
           @endif
           class="needs-validation" novalidate="">
        @csrf
        <div class="row g-3">
            <div class="col-sm-6">
                <label for="firstName" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" placeholder="User name" required="">
                <div class="invalid-feedback">
                    Valid name is required.
                </div>
            </div>

            @if ($user->id)
                <div class="col-sm-6 pt-4">
                    <a class="text-white btn btn-danger btn-sm mt-2 float-right" href="/user/{{ $user->id }}/delete">
                        Delete
                    </a>
                </div>
            @endif

            <div class="col-12">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" placeholder="you@example.com">
                <div class="invalid-feedback">
                    Please enter a valid email address for shipping updates.
                </div>
            </div>

            @if (!$user->id)
                <div class="col-12">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" value="" placeholder="">
                </div>
            @endif


            <div class="col-12">
                <label for="description" class="form-label">About user</label>
                <input type="description" class="form-control" id="url" name="description" value="@if ($user->profile) {{ $user->profile->description }} @endif" placeholder="">
            </div>

            <div class="col-sm-6">
                <button class="w-50 btn btn-primary btn-sm" type="submit">Save</button>
            </div>
        </div>

        <hr class="my-4">

    </form>
@endsection
