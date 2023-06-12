<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Admin Panel</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="{{asset('panel/img/favicon.ico')}}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet"> 
    
    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


    <!-- Libraries Stylesheet -->
    <!-- <link href="{{asset('panel/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
     <link href="{{asset('panel/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css')}}" rel="stylesheet" /> -->

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('panel/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{asset('panel/css/style.css')}}" rel="stylesheet">
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sign In Start -->
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <div class="bg-secondary rounded p-4 p-sm-5 my-4 mx-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h3>Sign In</h3>
                        </div>
                        @if(Session::has('error'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>{{session::get('error')}}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                         @endif
                        <form action="{{route('nadmin.login')}}" class="" method="post">
                            @csrf
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control"  name="email" placeholder="name@example.com">
                            <label for="email">Email address</label>
                        </div>
                        <div class="form-floating mb-4">
                       
                            <input type="password" class="form-control"  name="password" placeholder="Password">
                            <label for="password">Password  </label>
                            <!-- <i class="far fa-eye" id="togglePassword"></i> -->
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input">
                                <label class="form-check-label" for="exampleCheck1">Remember me</label>
                            </div>
                            <a href="">Forgot Password</a>
                        </div>
                        <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Sign In</button>
                        <p class="text-center mb-0">Don't have an Account? <a href="{{route('admin.register')}}">Sign Up</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sign In End -->
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>    
    <!-- <script src="{{asset('panel/lib/chart/chart.min.js')}}"></script>
    <script src="{{asset('panel/easing/easing.min.js')}}"></script>
    <script src="{{asset('panel/lib/waypoints/waypoints.min.js')}}"></script>
    <script src="{{asset('panel/lib/owlcarousel/owl.carousel.min.js')}}"></script>
    <script src="{{asset('panel/lib/tempusdominus/js/moment.min.js')}}"></script>
    <script src="{{asset('panel/lib/tempusdominus/js/moment-timezone.min.js')}}"></script>
    <script src="{{asset('panel/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js')}}"></script> -->

    <!-- Template Javascript -->
    <script src="{{asset('panel/js/main.js')}}"></script>
</body>

</html>