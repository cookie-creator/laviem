<nav aria-label="breadcrumb ">
    <ol class="breadcrumb py-2 px-3 bg-gray-200">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('users') }}">Users</a></li>
        <li class="breadcrumb-item"><a href="{{ url("/user/{$user->id}") }}">{{ $user->name }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{$bookmark->name}}</li>
    </ol>
</nav>
