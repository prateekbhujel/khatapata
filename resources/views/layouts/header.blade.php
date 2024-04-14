<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <!-- Display logo image if available, otherwise display website name -->
        <a class="navbar-brand" href="{{ route('home') }}">
            @if ($settings && $settings->logo)
                <!-- If logo URL is available, display the logo image -->
                <img src="{{ asset($settings->logo) }}" alt="{{ $settings->name }}" class="navbar-brand-logo" style="max-width: 100px; height: auto;">
            @else
                <!-- If logo URL is not available, display the website name as text -->
                <span class="navbar-brand-text">{{ $settings->name }}</span>
            @endif
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#about">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#features">Features</a>
                </li>
                @if (Auth::check())
                    <li class="nav-item" style="margin-left: 550%">
                        <a class="nav-link btn btn-link text-bg-info me-2" href="{{ route('user.dashboard.index') }}"><i class="fas fa-user-alt text-white"></i></a>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="nav-link btn btn-link text-bg-danger"><i class="fas fa-power-off"></i></button>
                        </form>
                    </li>
                @else
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('login') ? 'active' : '' }}" href="{{ route('login') }}">Login</a>
                </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
