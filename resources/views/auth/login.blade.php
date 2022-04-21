<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="robots" content="noindex" />
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login</title>
  <!--Open Sans Font [ OPTIONAL ]-->
  <link href="{{ asset('assets/fonts/openSans.css') }}" rel='stylesheet' type='text/css'>
  <!--Bootstrap Stylesheet [ REQUIRED ]-->
  <link href="{{ asset('assets/css/bootstrap1.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/css/materialdesignicons.min.css') }}">

  <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
</head>

<body>
  <main class="d-flex align-items-center min-vh-100 py-3 py-md-0"
    style="width:100%; height:100%; background-size: cover; background-image: url({{ asset('assets/svg/web-header-bg.svg') }}">
    <div class="container">
      <div class="card login-card">
        <div class="row no-gutters">
          <div class="col-md-7">
            <img src="{{ asset('assets/img/distribution_logo.jpg') }}" alt="login"
              style="background-size:cover;padding-left:50px;width:650px;height:600px;object-fit:contain;">
          </div>
          <div class="col-md-5">
            <div class="card-body">
              {{-- <div class="brand-wrapper">
                <img src="{{ asset('assets/img/cartlogo.png') }}" alt="logo" class="logo">
            </div> --}}
            <p class="login-card-description">Sign into your account</p>
            <form method="POST" action="{{ route('login') }}">
              {{csrf_field()}}
              <div class="form-group">
                <label for="username" class="sr-only">Username</label>
                <input type="username" name="username" id="username"
                  class="form-control @error('username') is-invalid @enderror" placeholder="Username"
                  value="{{ old('username') }}" required autocomplete="username" autofocus>
                @error('username')
                <span class="invalid-feedback" role="alert">
                  <strong style="color: #fd4700;">{{ $message }}</strong>
                </span>
                @enderror
              </div>
              <div class="form-group mb-4">
                <label for="password" class="sr-only">Password</label>
                <input type="password" name="password" id="password"
                  class="form-control @error('password') is-invalid @enderror" placeholder="Password" required
                  autocomplete="current-password">
                @error('password')
                <span class="invalid-feedback" role="alert">
                  <strong style="color: #fd4700;">{{ $message }}</strong>
                </span>
                @enderror
              </div>
              <input name="login" id="login" class="btn btn-block login-btn mb-4" type="submit" value="Sign In">
            </form>
            <a href="#!" class="forgot-password-link">Forgot password?</a>
            <p class="login-card-footer-text">Don't have an account? <a href="#!" class="text-reset">Register here</a>
            </p>
            <nav class="login-card-footer-nav">
              <a href="#!">Terms of use.</a>
              <a href="#!">Privacy policy</a>
            </nav>
          </div>
        </div>

      </div>
    </div>

    </div>
  </main>
  <!--jQuery [ REQUIRED ]-->
  <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/js/jquery-3.4.1.min.js') }}"></script>
  <script src="{{ asset('assets/js/popper.min.js') }}"></script>
  <!--BootstrapJS [ RECOMMENDED ]-->
  <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
</body>

</html>