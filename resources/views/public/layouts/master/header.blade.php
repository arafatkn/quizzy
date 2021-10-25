<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <!-- Site Logo Here -->
            <a class="navbar-brand" href="{{ config('app.url') }}">{{ config('app.name') }}</a>
            <!-- Mobile Toggle Button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMobileToggle" aria-controls="navbarMobileToggle" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarMobileToggle">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ config('app.url') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('index') }}">Quizzes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>

            @auth
                <!-- Right Side -->
                    <div class="btn-group float-end">
                        <a href="#" class="dropdown-toggle text-decoration-none text-light" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle"></i>
                            <span>{{ $user->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a href="{{ route('user.index') }}" class="dropdown-item"><i class="bi bi-speedometer"></i> Dashboard</a></li>
                            <li><a href="{{ route('user.settings.password') }}" class="dropdown-item"><i class="bi bi-lock-fill"></i> Change Password</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a href="{{ route('auth.logout') }}" class="dropdown-item"><i class="bi bi-box-arrow-right"></i> Log out</a></li>
                        </ul>
                    </div>
                @endauth

                @guest
                    <div class="float-end">
                        <a href="{{ route('auth.login') }}" role="button" class="btn btn-outline-warning">Login</a>
                        <a href="{{ route('auth.register') }}" role="button" class="btn btn-outline-secondary">Signup</a>
                    </div>
                @endguest
            </div>
        </div>
    </nav>
</header>
