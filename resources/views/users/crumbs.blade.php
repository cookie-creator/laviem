<nav aria-label="breadcrumb ">
    <ol class="breadcrumb py-2 px-3 bg-gray-200">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('users') }}">Users</a></li>
        @if ($user->id)
            <li class="breadcrumb-item active" aria-current="page">{{$user->name}}</li>
        @else
            <li class="breadcrumb-item active" aria-current="page">Create user</li>
        @endif
    </ol>
</nav>
