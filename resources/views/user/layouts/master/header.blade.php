<div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
    {{--<a href="/" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <span class="fs-5 d-none d-sm-inline">Menu</span>
    </a>--}}
    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
        <li class="nav-item">
            <a href="#" class="nav-link align-middle px-0">
                <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Home</span>
            </a>
        </li>
        <li>
            <a href="{{ route('user.quizzes.index') }}" class="nav-link px-0 align-middle">
                <i class="fs-4 bi-table"></i> <span class="ms-1 d-none d-sm-inline">Available Quizzes</span></a>
        </li>
        <li>
            <a href="{{ route('user.my_quizzes') }}" class="nav-link px-0 align-middle">
                <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">My Quizzes</span> </a>
        </li>
        <li>
            <a href="{{ route('user.quizzes.index') }}" class="nav-link px-0 align-middle">
                <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">My Attempts</span> </a>
        </li>
    </ul>
</div>

