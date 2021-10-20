@extends('public.auth.layout')

@section('title', 'Log In')

@section('content')
    <section class="vh-100" style="background-color: #508bfc;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card shadow-2-strong" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">

                            <h3 class="mb-5">Log In</h3>

                            @include('partial.alert')

                            <form action="" method="post" id="loginForm">
                                @csrf
                                <div class="form-floating mb-4">
                                    <input type="email" name="email" value="{{ old('email') }}" class="form-control form-control-lg" placeholder="Enter your email" />
                                    <label class="form-label" for="typeEmailX">Email</label>
                                </div>

                                <div class="form-floating mb-4">
                                    <input type="password" name="password" value="{{ old('password') }}" class="form-control form-control-lg" placeholder="Enter your password" />
                                    <label class="form-label" for="typePasswordX">Password</label>
                                </div>

                                <!-- Checkbox -->
                                <div class="form-check text-start mb-4">
                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        name="remember"
                                        value="1"
                                    />
                                    <label class="form-check-label" for="checkbox"> Remember password </label>
                                </div>

                                <div class="d-grid">
                                    <button class="btn btn-primary btn-lg" type="submit">Login</button>
                                </div>
                            </form>

                            <hr class="my-4">

                            <div class="d-grid gap-2">
                                <a href="{{ route('auth.register') }}" class="btn btn-lg btn-secondary">Create a new account</a>
                            </div>

                            <div class="text-center">
                                <a href="{{ route('index') }}" role="button" class="btn btn-link mt-2">Back to Home</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
