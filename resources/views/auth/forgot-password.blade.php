<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Admin panel</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet"> 
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('panel/css/bootstrap.min.css')}}" rel="stylesheet" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{asset('panel/css/style.css')}}" rel="stylesheet">

</head>
<body>
 
    <div class="container-fluid position-relative d-flex p-0">
        <div class="container-fluid position-relative d-flex p-0">
            <!-- Spinner Start -->
            <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
                <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
            <!-- Spinner End -->
            <body>
            <div class="container-fluid">
                <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                    <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                        <div class="bg-secondary rounded p-4 p-sm-5 my-4 mx-3">
                        <form method="POST" class="my-login-validation" action="{{ route('password.email') }}">
                            @csrf
                            @if(session('status'))
                                <div class="alert alert-success ">
                                    {{ session('status') }}
                            @elseif(session('email'))
                                <div class="alert alert-success ">
                                    {{ session('email') }}
                                </div>
                            @endif
                            <div class="card text-center" style="width: 300px;">
                                <div class="card-header h5 text-white bg-primary">Password Reset</div>
                                <div class="card-body px-5">
                                    <p class="card-text py-2">
                                        Enter your email address and we'll send you an email with instructions to reset your password.
                                    </p>
                                    <div class="form-outline">
                                        <label class="form-label" for="email">Email input</label>
                                        <input type="email" name="email" class="form-control my-3"  value="{{old('email')}}" placeholder="example@example.com"/>
                                        
                                        <span class="text-danger">@error('email'){{$message}}@enderror</span>
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100">Send Reset Link</button>
                                    <div class="d-flex justify-content-between mt-4">
                                        <a class="{{route('login')}}" href="#">Login</a>
                                        <a class="{{route('register')}}" href="#">Register</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    <!-- </div> -->
                <!-- </div> -->
            </div>
            
            </body>


            <!-- Footer Start -->
            <div class="container-fluid pt-3 px-4 mt-3 ">
                <div class="bg-secondary rounded-top p-4 mt-3">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start ">
                            &copy; <a href="#">YFJ</a>, All Right Reserved. 2023
                        </div>
                        <div class="col-12 col-sm-6 text-center text-sm-end">
                            Designed By <a href="#">TEAM YFJ</a>
                            <br>Distributed By: <a href="#" target="_blank">YFJ</a>
                        </div>
                    </div>
                </div>
            </div>
            <!--footer End -->
            </div>
            <!-- Content End -->

              <!-- Back to Top -->
              <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
            </div>  
        </div> 
        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Template Javascript -->
    <script src="{{asset('panel/js/main.js')}}"></script>
</body>

</html>
