@section('bookmark-form')

    <form  method="POST"
        @if ($bookmark->name)
            action="/user/{{ $user->id }}/bookmark/{{ $bookmark->id }}/update"
        @else
            action="/user/{{ $user->id }}/bookmark-store"
        @endif
        class="needs-validation" novalidate="">
        @csrf
        <div class="row g-3">
            <div class="col-sm-6">
                <label for="firstName" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $bookmark->name }}" placeholder="User name" required="">
                <div class="invalid-feedback">
                    Valid name is required.
                </div>
            </div>

            @if ($bookmark->name)
                <div class="col-sm-6 pt-4">
                    <a class="text-white btn btn-danger btn-sm mt-2 float-right" href="/user/{{ $user->id }}/bookmark/{{ $bookmark->id }}/delete">
                        Delete
                    </a>
                </div>
            @endif

            <div class="col-12">
                <div class="input-group has-validation">
                    <div class="col-12">
                        <label for="category" class="form-label">Category</label>
                    </div>
                    <div class="col-12 col-lg-6 col-md-6">
                        <select name="category_id" class="form-control">
                            @foreach ($categories as $item)
                                <option value="{{ $item->id }}"
                                    @if ($bookmark->category)
                                        @if ($item->id == $bookmark->category->id)
                                            selected="selected"
                                        @endif
                                    @endif
                                >
                                {{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="input-group has-validation">
                    <span class="input-group-text">URL</span>
                    <input type="text" class="form-control" id="url" name="url" value="{{ $bookmark->url }}" placeholder="User saved url" required="">
                    <div class="invalid-feedback">
                        Url is required.
                    </div>
                </div>
            </div>

            <div class="col-12">
                <label for="description" class="form-label">Short description</label>
                <input type="description" class="form-control" id="url" name="description" value="@if ($bookmark->details) {{ $bookmark->details->description }} @endif" placeholder="">
            </div>

            <div class="col-sm-6">
                <button class="w-50 btn btn-primary btn-sm" type="submit">Save</button>
            </div>
        </div>

    </form>
@endsection
