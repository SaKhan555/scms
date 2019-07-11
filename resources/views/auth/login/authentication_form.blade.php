<html lang="en"><head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>SB Admin - Login</title>
    <!-- Bootstrap core CSS-->
    <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin.css') }}" rel="stylesheet">

  </head>

  <body style="background: #f9f9f9;">
  <div class="card card-login mx-auto mt-5">
    <div class="card-body" style="background: #ecececf2 !important;">
    <div class="text-center">
      <img src="{{ asset('/uploads/logo/login_logo.png') }}" alt="Login" class="img-responsive" style="margin: -20px 0px;
    width: 60px;">
    </div>
      <hr>
      <form method="post" action="{{ route('login.authenticate') }}">
        {{ csrf_field() }}
        <div class="form-group">
          <div class="form-row">
            <div class="col-md-12">
              <label class="h6">Email: </label>
              <input class="form-control form-control-sm" placeholder="Email" required="required" autofocus="email" type="text" id="email" name="email">
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-12">
                <label class="h6" style="margin-top: 10px;">Password: </label>
                <input class="form-control form-control-sm" placeholder="Password" required="required" type="password" name="password">
              </div>
            </div>
          </div>
        </div>
        <hr>
        <div class="form-group">
          <div class="form-row">
            <div class="col-md-12" style="text-align: center;">
              <button type="submit" class="btn btn-secondary btn-block btn-sm">Login</button>
            </div>
          </div>
        </div>

      </form>
      <div class="text-center" id="msg_box">
        @if(count($errors->all()))
        <ul class="alert alert-danger">
          @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
        @endif

        @if($flash = session('failure_msg'))
        <p style="color: #fef4f4;background: #535050;">{{ $flash }}</p>
        @endif

      </div>
    </div>
  </div>
    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('/js/jquery.min.js') }}"></script>
    <script src="{{ asset('/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Core plugin JavaScript-->
    <script src="{{ asset('/jquery.easing.min.js') }}"></script>
</body></html>