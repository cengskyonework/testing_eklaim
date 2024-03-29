<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
    <meta name="description" content="">
    <title>{{ get_option('site_title', 'E-KLAIM INACO') }}</title>
    <link rel="shortcut icon" href="images/logo.png" />
    <link rel="stylesheet" href="assets_homepage/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets_homepage/bootstrap/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="assets_homepage/bootstrap/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="assets_homepage/animatecss/animate.css">
    <link rel="stylesheet" href="assets_homepage/theme/css/style.css">
    <link rel="preload"
        href="https://fonts.googleapis.com/css?family=Inter+Tight:100,200,300,400,500,600,700,800,900,100i,200i,300i,400i,500i,600i,700i,800i,900i&display=swap"
        as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css?family=Inter+Tight:100,200,300,400,500,600,700,800,900,100i,200i,300i,400i,500i,600i,700i,800i,900i&display=swap">
    </noscript>
    <link rel="preload" as="style" href="assets_homepage/mobirise/css/mbr-additional.css?v=BJ20ut">
    <link rel="stylesheet" href="assets_homepage/mobirise/css/mbr-additional.css?v=BJ20ut" type="text/css">
</head>

<body>
    <section data-bs-version="5.1" class="header1 cid-u2atkuPAkN" id="header01-1i">
        <div class="container">
            <div class="row justify-content-center" style="margin: 9vh">
                <div class="col-12 col-md-12 col-lg-6 image-wrapper">
                    <img class="w-100" src="assets_homepage/images/mini-jelly-4-893x712.png">
                </div>
                <div class="col-12 col-lg col-md-12">
                    <div class="text-wrapper align-left">
                        <h1 class="mbr-section-title mbr-fonts-style mb-4 display-2">
                            <strong>Selamat Datang</strong><br><strong> di E-Claim</strong>
                        </h1>
                        <p class="mbr-text mbr-fonts-style mb-4 display-7">
                            PT. Niramas Utama (Inaco)</p>
                        <div class="mbr-section-btn mt-3">
                            @if (Auth::check())
                                <p class="mbr-text mbr-fonts-style mb-4 display-7 m-2">
                                    Anda sudah login, Silahkan
                                    <a href="dashboard" style="color: orange"><strong> Kembali ke Dashboard</strong></a>
                                </p>
                            @else
                                <a class="btn btn-secondary display-7" href="login">Login Sekarang</a>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="assets_homepage/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets_homepage/smoothscroll/smooth-scroll.js"></script>
    <script src="assets_homepage/ytplayer/index.js"></script>
    <script src="assets_homepage/theme/js/script.js"></script>


    <input name="animation" type="hidden">
</body>

</html>
