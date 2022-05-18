@section('header')
<header class="bg-dark text-white">
    <div class="row px-2">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="{{ route('dashboard') }}" class="nav-link px-2
                    {{ request()->is('dashboard') ? 'text-secondary' : 'text-white' }}">Home</a></li>
                <li><a href="{{ route('users') }}" class="nav-link px-2
                    {{ (request()->is('users') || request()->is('users/*')) ? 'text-secondary' : 'text-white' }}">Users</a></li>
                <li><a href="{{ route('notifications') }}" class="nav-link px-2
                    {{ request()->is('notifications') ? 'text-secondary' : 'text-white' }}">Notifications</a></li>
            </ul>
        </div>
    </div>
</header>
@endsection
