@section('category-form')
    <form  method="POST"
           @if ($category->name)
            action="/user/{{ $user->id }}/category/{{ $category->id  }}/update"
           @else
            action="/user/{{ $user->id }}/category-store"
           @endif
           class="needs-validation" novalidate="">
        @csrf
        <div class="row g-3">
            <div class="col-sm-6">
                <label for="firstName" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}" placeholder="Name" required="">
                <div class="invalid-feedback">
                    Valid name is required.
                </div>
            </div>

            <div class="col-sm-6 pt-4">
                @if ($category->name)
                <a class="text-white btn btn-danger btn-sm mt-2 float-right" href="/user/{{ $user->id }}/category/{{ $category->id }}/delete">
                    Delete
                </a>
                @endif
            </div>

            <div class="col-sm-6">
                <button class="w-50 btn btn-primary btn-sm" type="submit">Save</button>
            </div>
        </div>

    </form>
@endsection
