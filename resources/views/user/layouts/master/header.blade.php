<div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
    {{--<a href="/" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <span class="fs-5 d-none d-sm-inline">Menu</span>
    </a>--}}
    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
        <li class="nav-item">
            <a href="{{ route('user.index') }}" class="nav-link align-middle px-0">
                <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Home</span>
            </a>
        </li>
        <li>
            <a href="{{ route('user.quizzes.create') }}" class="nav-link px-0 align-middle">
                <i class="fs-4 bi-plus-circle"></i> <span class="ms-1 d-none d-sm-inline">Add New Quiz</span></a>
        </li>
        <li>
            <a href="{{ route('user.quizzes.index') }}" class="nav-link px-0 align-middle">
                <i class="fs-4 bi-table"></i> <span class="ms-1 d-none d-sm-inline">Available Quizzes</span></a>
        </li>
        <li>
            <a href="{{ route('user.my_quizzes') }}" class="nav-link px-0 align-middle">
                <i class="fs-4 bi-person-check"></i> <span class="ms-1 d-none d-sm-inline">My Quizzes</span> </a>
        </li>
        <li>
            <a href="{{ route('user.attempts.index') }}" class="nav-link px-0 align-middle">
                <i class="fs-4 bi-hand-index"></i> <span class="ms-1 d-none d-sm-inline">My Attempts</span> </a>
        </li>
        <li>
            <a href="{{ route('user.settings.profile') }}" class="nav-link px-0 align-middle">
                <i class="fs-4 bi-person"></i> <span class="ms-1 d-none d-sm-inline">My Profile</span> </a>
        </li>
        <li>
            <a href="{{ route('user.settings.password') }}" class="nav-link px-0 align-middle">
                <i class="fs-4 bi-gear"></i> <span class="ms-1 d-none d-sm-inline">Chnage Password</span> </a>
        </li>
        <li>
            <a href="{{ route('auth.logout') }}" class="nav-link px-0 align-middle">
                <i class="fs-4 bi-box-arrow-right"></i> <span class="ms-1 d-none d-sm-inline">Logout</span> </a>
        </li>
    </ul>
</div>

