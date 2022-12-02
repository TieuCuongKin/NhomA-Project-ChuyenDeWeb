<!DOCTYPE html>
<html lang="en">
<meta name="csrf-token" content="{{ csrf_token() }}">
<head>
    <meta charset="utf-8">
    <title>Website Find Job</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="/img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@700;800&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link type="text/css" rel="stylesheet" href='{{ url("/css/bootstrap.min.css") }}' />

    <!-- Template Stylesheet -->
    <link type="text/css" rel="stylesheet" href="{{ url('/css/style.css') }}" />

</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Navbar Start -->
        <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
            <a href="{{ route('index') }}" class="logo">
                <img src="{{ asset('/img/logo.png') }}" alt="">
            </a>
            <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto p-4 p-lg-0">
                    <a href="{{ route ('index') }}" class="nav-item nav-link active">Home</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Job IT</a>
                        <div class="dropdown-menu rounded-0 m-0">
                            <a href="{{ route ('joblist') }}" class="dropdown-item">Job List</a>
                            <a href="{{ route ('jobdetail') }}" class="dropdown-item">Job Detail</a>
                            <a href="{{ route ('company') }}" class="dropdown-item">Company</a>
                            <a href="{{ route ('testimonial') }}" class="dropdown-item">Testimonial</a>
                        </div>
                    </div>
                </div>
            </div>
                <div class="col-lg-4 text-center bg-w py-4 pt-4">
                    <div class="d-inline-flex align-items-center justify-content-center">
                    @if(Auth::guard('cus')->check())
                        <h6><i class="fa-solid fa-user text-primary"></i><a href="{{ url('thongtinkh',Auth::guard('cus')->user()->id) }}"> {{ Auth::guard('cus')->user()->full_name }}</a></h6>
                        <div class="text-start ps-5">
                            <a href="{{ route('logout') }}">
                                <h6 class="text-uppercase"><i class="fa-solid fa-right-from-bracket fs-3 text-danger exit-account"></i></h6>
                            </a>
                        </div>
                        @else
                        <div class="text-start">
                            <a href="{{ route('login') }}">
                                <h6 class="text-uppercase"><i class="fa fa-users fs-3 text-primary "></i> Đăng Nhập</h6>
                            </a>
                        </div>
                        <div class="text-start ps-5">
                            <a href="{{ route('register') }}">
                                <h6 class="text-uppercase"><i class="fa fa-edit fs-3 text-primary"></i> Đăng Kí</h6>
                            </a>
                        </div>
                        @endif

                    </div>

                </div>
        </nav>
        <!-- Navbar End -->
        <nav class="navbar navbar-expand-lg bg-dark navbar-dark shadow-sm py-3 py-lg-0 px-3 px-lg-0">
            <a href="{{route('index')}}" class="navbar-brand d-block d-lg-none">
                <h1 class="m-0 text-uppercase text-white"><i class="fa fa-birthday-cake fs-1 text-primary me-3 "></i>Delicious</h1>
            </a>
            @if(Auth::guard('cus')->check())
            <a href="{{ route('logout') }}" class="navbar-brand d-block d-lg-none">
                <h1 class="m-0 text-uppercase text-white"><i class="fa-solid fa-right-from-bracket text-danger"></i></h1>
            </a>
            @else
            <a href="{{ route('login') }}" class="navbar-brand d-block d-lg-none">
                <h1 class="m-0 text-uppercase text-white"><i class="fa-solid fa-user"></i></h1>
            </a>
            @endif


        </nav>


        @yield('content')
        <script src="{{ asset('/js/ajax.js') }}"></script>
        <!-- Footer Start -->
        <div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-lg-3 col-md-6">
                        <h5 class="text-white mb-4">Company</h5>
                        <a class="btn btn-link text-white-50" href="">About Us</a>
                        <a class="btn btn-link text-white-50" href="">Contact Us</a>
                        <a class="btn btn-link text-white-50" href="">Our Services</a>
                        <a class="btn btn-link text-white-50" href="">Privacy Policy</a>
                        <a class="btn btn-link text-white-50" href="">Terms & Condition</a>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h5 class="text-white mb-4">Hot Job</h5>
                        <a class="btn btn-link text-white-50" href="">About Us</a>
                        <a class="btn btn-link text-white-50" href="">Contact Us</a>
                        <a class="btn btn-link text-white-50" href="">Our Services</a>
                        <a class="btn btn-link text-white-50" href="">Privacy Policy</a>
                        <a class="btn btn-link text-white-50" href="">Terms & Condition</a>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h5 class="text-white mb-4">Contact</h5>
                        <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>123 Street, New York, USA</p>
                        <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+012 345 67890</p>
                        <p class="mb-2"><i class="fa fa-envelope me-3"></i>info@example.com</p>
                        <div class="d-flex pt-2">
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h5 class="text-white mb-4">Newsletter</h5>
                        <p>Dolor amet sit justo amet elitr clita ipsum elitr est.</p>
                        <form action="{{ url('/mail') }}" method="GET">
							<input class="input" name="mail" type="email" placeholder="Enter Your Email">
							<button class="newsletter-btn"><i class="fa fa-envelope"></i> Subscribe</button>
						</form>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="copyright">
                    <div class="row">
                        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                            &copy; <a class="border-bottom" href="#">Website Job IT</a>, All Right Reserved.

                            <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                            Designed By <a class="border-bottom" href="https://www.facebook.com/FakerVietNam">Website Job IT</a>
                        </div>
                        <div class="col-md-6 text-center text-md-end">
                            <div class="footer-menu">
                                <a href="">Home</a>
                                <a href="">Cookies</a>
                                <a href="">Help</a>
                                <a href="">FQAs</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('/js/main.js') }}"></script>
    <script type="text/javascript">
           $('.category-filter').click(function(){
                var category = [],tempArray = [];

                $.each($("[data-filters='category']:checked"),function(){
                    tempArray.push($(this).val());
                   
                });
                tempArray.reverse();
                if(tempArray.length !== 0){
                    category += '?cate=' + tempArray.toString();
                }
                window.location.href = category;
            });
    </script>
    <script src="{{ asset('js/ajax.js') }}"></script>
</body>

</html>