
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
        <link rel="stylesheet" href="{{url('USER/css/styleLogin.css')}}">
    </head>

    <body>

        <div class="container" id="container">
            <div class="form-container sign-up">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <h5>Create Account</h5>
                    <div class="social-icons">
                        <a href="{{ url('login/google') }}" class="icon"><img class="goggle" src="{{url('USER/img/google.png')}}" alt="">Sign up with google</a>
                    </div>
                    <span>or use your email for registeration</span>
                    <input placeholder="Name" id="name" type="text"
                        class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"
                        required autocomplete="name" autofocus>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <input placeholder="Email" id="email" type="email"
                        class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"
                        required autocomplete="email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <input placeholder="Password" id="password" type="password"
                        class="form-control @error('password') is-invalid @enderror" name="password" required
                        autocomplete="new-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <input placeholder="Confirm Password" id="password-confirm" type="password" class="form-control"
                        name="password_confirmation" required autocomplete="new-password">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Register') }}
                    </button>
                </form>
            </div>
            <div class="form-container sign-in">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <h1>Sign In</h1>
                    <div class="social-icons">
                        <a href="{{ url('login/google') }}" class="icon"><img class="goggle" src="{{url('USER/img/google.png')}}" alt="">Sign in with google</a>
                    </div>
                    <span>or use your email password</span>
                    <input placeholder="Email" id="email" type="email"
                        class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"
                        required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <input placeholder="Password" id="password" type="password"
                        class="form-control @error('password') is-invalid @enderror" name="password" required
                        autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                    <button type="submit" class="btn btn-primary">
                        {{ __('Login') }}
                    </button>
                </form>
            </div>
            <div class="toggle-container">
                <div class="toggle">
                    <div class="toggle-panel toggle-left">
                        <h1>Welcome Back!</h1>
                        <p>Log in if you already have a account</p>
                        <button class="hidden" id="login">Sign In</button>
                        <button class="hidden"><a class="text-light" href="{{ url('/') }}">Kembali</a></button>
                    </div>
                    <div class="toggle-panel toggle-right">
                        <h1>Hello, Friend!</h1>
                        <p>Don't Forget to regist first</p>
                        <button class="hidden" id="register">Sign Up</button>
                        <button class="hidden"><a class="text-light" href="{{ url('/') }}">Kembali</a></button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            const container = document.getElementById('container');
            const registerBtn = document.getElementById('register');
            const loginBtn = document.getElementById('login');

            registerBtn.addEventListener('click', () => {
                container.classList.add("active");
            });

            loginBtn.addEventListener('click', () => {
                container.classList.remove("active");
            });
        </script>
    </body>

    </html>

