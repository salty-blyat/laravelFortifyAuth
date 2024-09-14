<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
</head>

<body class="font-sans antialiased">
    <!-- navbar -->
    <x-navbar />

    <div class="container mt-5">
        @if (request()->is('/'))
        <!-- for not auth -->
        @guest
        <p>You are not logged in.</p>
        @endguest
        <!-- Home page after logged in -->
        @auth
        @if ( session('status') === 'verification-link-sent' )
        <div class="alert alert-info" role="alert">
            A new verification link has been sent to your email address.
        </div>
        @endif
        <h1 class="mb-3">Welcome, {{ Auth::user()->name }}</h1>
        @if (!Auth::user()->hasVerifiedEmail())
        <div class="card p-4 text-secondary">
            <h5 class="card-title">
                It seems like your email is not verified yet.
            </h5>
            <p class="card-text">Please click here to verify your email.</p>
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="btn btn-dark">
                    Verify email
                </button>
            </form>
        </div>
        @endif
        @endauth @endif
    </div>

    <div class="container mt-5">
        <!-- LOGIN -->
        @if (request()->routeIs('login'))
        <h2 class="text-center">Login</h2>
        <!-- err handling -->
        <x-err-handling />
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" name="email" required autofocus />
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required />
            </div>
            <div class="form-check mt-2">
                <input type="checkbox" class="form-check-input" id="remember" name="remember" />
                <label class="form-check-label" for="remember">Remember me</label>
            </div>
            <button type="submit" class="btn btn-primary btn-block">
                Login
            </button>
        </form>
        <div class="text-center mt-3">
            <a href="/reset-password">Forget password?</a>
            <p>
                Don't have an account?
                <a href="{{ route('register') }}">Sign up</a>
            </p>
        </div>

        <!-- reset password -->
        @elseif (request()->routeIs('reset-password'))
        <h2 class="text-center">Reset Password</h2>
        <!-- err handling -->
        <x-err-handling />
        <form method="POST" action="{{ route('password.email') }}">
            @csrf @if( $message = session('status'))
            <div class="alert alert-danger">
                email
                {{ $message }}
            </div>
            @endif
            <div class="form-group">
                <label for="email">Email address</label>

                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                    required autofocus />
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary btn-block">
                Reset Password
            </button>
        </form>
        <div class="text-center mt-3">
            <p>
                Don't have an account?
                <a href="{{ route('register') }}">Sign up</a>
            </p>
        </div>

        <!-- SIGNUP -->
        @elseif (request()->routeIs('register'))
        <h2 class="text-center">Sign Up</h2>
        <!-- err handling -->
        <x-err-handling />
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" required autofocus />
            </div>
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" name="email" required />
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required />
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                    required />
            </div>

            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" />
                    <label class="form-check-label" for="remember">
                        Remember Me
                    </label>
                </div>
            </div>

            <button type="submit" class="btn btn-success btn-block">
                Sign Up
            </button>
        </form>
        <div class="text-center mt-3">
            <a href="/reset-password">Forget password?</a>
            <p>
                Already have an account?
                <a href="{{ route('login') }}">Login</a>
            </p>
        </div>

        <!-- get email back from mailtrap -->
        @elseif (request()->routeIs('reset-password-update'))
        <h2 class="text-center">Reset Password</h2>
        <form method="POST" action="{{ route('password.update') }}">
            @csrf @if( $message = session('status'))
            <div class="alert alert-danger">
                {{ $message }}
            </div>
            @endif
            <div class="form-group">
                <label for="email">Email address</label>
                <input value="{{ $email }}" type="email" class="form-control" id="email" name="email" required
                    autofocus />
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required />
            </div>
            <div class="form-group">
                <label for="assword_confirmation">Confirm Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                    required />
                <input type="hidden" class="form-control" name="token" value="{{ $token }}" required />
            </div>

            <button type="submit" class="btn btn-primary">
                Change password
            </button>
        </form>
        <div class="text-center mt-3">
            <p>
                Don't have an account?
                <a href="{{ route('register') }}">Sign up</a>
            </p>
        </div>
        @endif
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>

</html>