<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>EShopper - Bootstrap Shop Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ url('frontant/css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

</head>

<body>
    {{-- @if (getdata()->isNotEmpty()) --}}
                    @foreach (getdata() as $get)
    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row bg-secondary py-2 px-xl-5">
            <div class="col-lg-6 d-none d-lg-block">
                <div class="d-inline-flex align-items-center">
                    <a class="text-dark" href="">FAQs</a>
                    <span class="text-muted px-2">|</span>
                    <a class="text-dark" href="">Help</a>
                    <span class="text-muted px-2">|</span>
                    <a class="text-dark" href="">Support</a>
                </div>
            </div>
              
            <div class="col-lg-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    @if (!empty($get->fasebook))
                                 <a class="text-dark px-2" href="{{ $get->fasebook }}">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    @endif
                      
                    @if (!empty($get->twitter))
                    <a class="text-dark px-2" href="{{ $get->twitter }}">
                        <i class="fab fa-twitter"></i>
                    </a>
                    @endif
                    @if (!empty($get->linkdin))

                    <a class="text-dark px-2" href="{{ $get->linkdin }}">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    @endif
                    @if (!empty($get->instagram))

                    <a class="text-dark px-2" href="{{ $get->instagram }}">
                        <i class="fab fa-instagram"></i>
                    </a>
                    @endif
                    @if (!empty($get->youtube))
                    <a class="text-dark pl-2" href="{{ $get->youtube }}">
                        <i class="fab fa-youtube"></i>
                    </a>
                    @endif

                </div>
            </div>
        </div>
        <div class="row align-items-center py-3 px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a href="" class="text-decoration-none">
                    <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">{{ $get->logo_first_text }}</span>{{ $get->logo_second_text }}</h1>
                </a>
            </div>
            <div class="col-lg-6 col-6 text-center">
                @if (!empty($get->heading))
                <h2>{{ $get->heading }}</h2>
                @endif
            </div>
            <div class="col-lg-3 col-6 text-right">
                <a href="" class="btn border">
                    <i class="fas fa-heart text-primary"></i>
                    <span class="badge">0</span>
                </a>
                <a href="" class="btn border">
                    <i class="fas fa-shopping-cart text-primary"></i>
                    <span class="badge">0</span>
                </a>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid">
        <div class="row border-top px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px;">
                    <h6 class="m-0">Categories</h6>
                    <i class="fa fa-angle-down text-dark"></i>
                </a>
                <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0 bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 1;">

                    <div class="navbar-nav w-100 overflow-hidden" style="height: 410px">
                        @foreach (getcategories() as $category )
                       @if ($category->parent->isNotEmpty())
                               <div class="nav-item dropdown">
                            <a href="#" class="nav-link" data-toggle="dropdown">{{ $category->name }} <i class="fa fa-angle-down float-right mt-1"></i></a>
                            <div class="dropdown-menu position-absolute bg-secondary border-0 rounded-0 w-100 m-0">
                                @foreach ($category->parent as $child)
                                <a href="" class="dropdown-item">{{ $child->name }}</a>
                                @endforeach
                            </div>
                        </div>
                       @else
                        <a href="" class="nav-item nav-link">{{ $category->name }}</a>
                           
                       @endif
                           
                        @endforeach
                    </div>
                </nav>
            </div>
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">{{ $get->logo_first_text }}</span>{{ $get->logo_second_text }}</h1>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
    @foreach (getmanu('main') as $menu)
        @if($menu->children->isNotEmpty())
            <div class="nav-item dropdown">
                <a <a href="{{ $menu->url}}" class="nav-link dropdown-toggle" data-toggle="dropdown">{{ $menu->name }}</a>
                <div class="dropdown-menu rounded-0 m-0">
                    @foreach ($menu->children as $submenu)
                        <a href="{{ $submenu->full_url }}" class="dropdown-item">{{ $submenu->name }}</a>
                    @endforeach
                </div>
            </div>
        @else
            <a href="{{ $submenu->full_url }}" class="nav-item nav-link">{{ $menu->name }}</a>
        @endif
    @endforeach
</div>
                        <div class="navbar-nav ml-auto py-0">
                            <a href="{{ route('login') }}" class="nav-item nav-link">Login</a>
                            <a href="{{ route('register') }}" class="nav-item nav-link">Register</a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    @yield('frontant-content')

    
    <!-- Footer Start -->
   @include('layout.auth.footer')
    <!-- Footer End -->

@endforeach
                     {{-- @endif --}}
                
    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    <script>
        //for country code mobile

        const phoneInputField = document.querySelector("#phone_number");
        const phoneInput = window.intlTelInput(phoneInputField, {
            initialCountry: "PK",
            separateDialCode: true,
            utilsScript:
            "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
        });

        $(document).ready(function(){
            $('#code').val('+'+phoneInput.s.dialCode);
            //for end country code mobile
            const errorMap = [":- Invalid phone number", ":- Invalid country code", ":- Phone Number is Too short", ":- Phone Number is Too long", ":- Invalid phone number"];
            $('#phone_number').keyup(function(){

                $('#code').val('+'+phoneInput.s.dialCode);

            });

            $('.iti__flag-container').click(function(){
                $('#code').val('+'+phoneInput.s.dialCode);
            });
        });

    </script>
</body>

</html>