<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
    <title>Login</title>
    <link rel="shortcut icon" href="images/logo.png" />
    <meta name="description" content="">
    <link rel="stylesheet" href="assets_login/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets_login/bootstrap/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="assets_login/bootstrap/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="assets_login/animatecss/animate.css">
    <link rel="stylesheet" href="assets_login/theme/css/style.css">
    <link rel="preload"
        href="https://fonts.googleapis.com/css?family=Inter+Tight:100,200,300,400,500,600,700,800,900,100i,200i,300i,400i,500i,600i,700i,800i,900i&display=swap"
        as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css?family=Inter+Tight:100,200,300,400,500,600,700,800,900,100i,200i,300i,400i,500i,600i,700i,800i,900i&display=swap">
    </noscript>
    <link rel="preload" as="style" href="assets_login/mobirise/css/mbr-additional.css?v=2yYCha">
    <link rel="stylesheet" href="assets_login/mobirise/css/mbr-additional.css?v=2yYCha" type="text/css">




</head>

<body>

    <section data-bs-version="5.1" class="form03 cid-u2aDx4xgMT" id="form03-1j">




        <div class="container-fluid">
            <div class="row justify-content-center" style="margin: 5vh">
                <div class="col-12 col-lg item-wrapper">
                    <div class="mbr-section-head mb-5">
                        <h3 class="mbr-section-title mbr-fonts-style align-center mb-0 display-5">
                            <strong>Silahkan login terlebih dahulu</strong>
                        </h3>

                    </div>

                    <div class="col-lg-5 mx-auto mbr-form" data-form-type="formoid">
                        <form method="POST" class="form-signin" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <input id="email" type="email"
                                        class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                        name="email" value="{{ old('email') }}" placeholder="{{ _lang('Email') }}"
                                        required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">

                                    <input id="password" type="password"
                                        class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                        name="password" placeholder="{{ _lang('Password') }}" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="remember" class="custom-control-input"
                                            id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="custom-control-label"
                                            for="remember">{{ _lang('Remember Me') }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-12">
                                    <div class="col-lg-12 col-md-12 col-sm-12 align-center mbr-section-btn"><button
                                            type="submit" class="btn btn-secondary display-7">&nbsp; &nbsp; &nbsp;
                                            &nbsp; &nbsp; &nbsp;Login&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</button>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>


                </div>


            </div>
        </div>
        <script src="assets_login/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets_login/smoothscroll/smooth-scroll.js"></script>
        <script src="assets_login/ytplayer/index.js"></script>
        <script src="assets_login/theme/js/script.js"></script>
        <script src="assets_login/formoid/formoid.min.js"></script>


        <input name="animation" type="hidden">
</body>

</html>
