@extends('public.auth.layout')

@section('title', 'Sign Up')

@section('content')
    <section class="vh-100" style="background-color: #508bfc;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card shadow-2-strong" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">

                            <h3 class="mb-5">Sign Up</h3>

                            @include('partial.alert')

                            <form action="" method="post">
                                @csrf
                                <div class="form-floating mb-4">
                                    <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="Enter your name" />
                                    <label class="form-label" for="name">Name</label>
                                </div>

                                <div class="form-floating mb-4">
                                    <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Enter your email" />
                                    <label class="form-label" for="email">Email</label>
                                </div>

                                <div class="form-floating mb-4">
                                    <input type="password" name="password" value="{{ old('password') }}" class="form-control" placeholder="Enter your password" />
                                    <label class="form-label" for="password">Password</label>
                                </div>

                                <div class="form-floating mb-4">
                                    <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" class="form-control" placeholder="Enter your password again" />
                                    <label class="form-label" for="password">Password Again</label>
                                </div>

                                <!-- Checkbox -->
                                <div class="form-check text-start mb-4">
                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        value=""
                                        id="remember"
                                        name="remember"
                                    />
                                    <label class="form-check-label" for="checkbox"> I agree to <a href="{{ route('pages.show', 'tos') }}">term & conditions</a> </label>
                                </div>

                                <div class="d-grid">
                                    <button class="btn btn-primary btn-lg" type="submit">Sign Up</button>
                                </div>
                            </form>

                            <hr class="my-4">

                            <div class="d-grid gap-2">
                                <a href="{{ route('auth.login') }}" class="btn btn-lg btn-secondary">I already have an account.</a>
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
