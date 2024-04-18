<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
        <a class="navbar-brand" href="{{ route('user.dashboard.index') }}">
            @if ($settings && $settings->logo)
                <img src="{{ asset($settings->logo) }}" alt="{{ $settings->name }}" class="navbar-brand-logo" style="max-width: 100px; height: auto;">
            @else
                {{ config('app.name') }}
            @endif
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @if(auth()->user()->status == 'Active')
                            
                    <li class="nav-item">
                        <a class="nav-link nav-item {{ request()->routeIs('user.categories.*') ? 'active' : '' }}" href="{{ route('user.categories.index') }}">
                            <i class="fa-solid fa-th-list me-2"></i>Categories
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link nav-item" href="#">
                            <i class="fas fa-money-bill-wave text-success me-2"></i>Expenses
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link nav-item" href="#">
                            <i class="fa-solid fa-gifts me-2"></i>Products
                        </a>
                    </li>
                @endif
            </ul>

            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-user-circle me-2"></i> 
                        {{ auth()->user()->name }}
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end">
                    
                    @if(auth()->user()->status == 'Active')
                        <li>
                            <a class="dropdown-item nav-item" href="{{ route('user.profile.edit') }}">
                                <i class="fa-solid fa-user-edit me-2"></i>Edit Profile
                            </a>
                        </li>
                        
                        <li>
                            <a class="dropdown-item" href="{{ route('user.password.edit') }}">
                                <i class="fa-solid fa-asterisk me-2"></i>Change Password
                            </a>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>
                    @endif

                        <li>
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-link-dropdown-item">
                                   <i class="fa-solid fa-arrow-right-from-bracket me-2"></i>Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>