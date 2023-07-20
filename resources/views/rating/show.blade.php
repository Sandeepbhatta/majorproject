<!-- Display Existing Ratings -->
@foreach($ratings as $rating)
    <div>
        <p>Rating: {{ $rating->rating }}</p>
        <p>Comment: {{ $rating->comment }}</p>
        <p>User: {{ $rating->user->name }}</p>
        <hr>
    </div>
@endforeach


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
            
            <!-- Sidebar Start -->
            <div class="sidebar pe-4 pb-3">
                
                <nav class="navbar bg-secondary navbar-dark">
                    <a href="{{asset('index.blade.php')}}" class="navbar-brand mx-4 mb-3">
                        <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>YFJ</h3>
                    </a>
                    <div class="d-flex align-items-center ms-4 mb-4">
                        <div class="position-relative">
                            <img class="rounded-circle" src="{{asset('panel/img/user.jpg')}}" alt="" style="width: 40px; height: 40px;">
                            <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                        </div>
                        <div class="ms-3">
                            <h6 class="mb-0">{{Auth::guard('admin')->user()->name}} {{Auth::guard('admin')->user()->email}}</h6>
                            <!-- <span>SuperAdmin Name : {{Auth::guard('admin')->user()->name}}</span> -->
                        </div>
                    </div>
                    <div class="navbar-nav w-100">
                        <a href="{{asset('index.blade.php')}}" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                        <a href="{{route('users.index')}}" class="nav-item nav-link "><i class="fa fa-tachometer-alt me-2"></i>Users</a>
                        <a href="{{route('package.index')}}" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>Package</a>
                        <a href="{{route('category.index')}}" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>Category</a>
                        <a href="{{route('booking.index')}}" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Booking</a>
                        <a href="{{route('invoice.payment')}}" class="nav-item nav-link "><i class="fa fa-file-alt me-2"></i>Invoice</a>
                        <a href="" class="nav-item nav-link "><i class="fa fa-table me-2"></i>Rating & review</a>
                        
                        @if(Auth::guard('admin')->user()->role == "superadmin")
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="far fa-file-alt me-2"></i>Create</a>
                            <div class="dropdown-menu bg-transparent border-0">
                                <a href="{{route('admin.register')}}" class="dropdown-item">Sign Up</a>
                            </div>
                        </div>
                        @endif
                    </div>
                </nav>
            </div>
            <!-- Sidebar End -->
                    <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <form action="" method="GET" class="d-none d-md-flex ms-4">
                    <input class="form-control bg-dark border-0" type="search" name="query" placeholder="Search">
                </form>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-envelope me-lg-2"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">

                                    
                                    <img class="rounded-circle" src="{{asset('panel/img/user.jpg')}}" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">{{Auth::guard('admin')->user()->name}}</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="{{asset('panel/img/user.jpg')}}" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">{{Auth::guard('admin')->user()->name}}</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">See all message</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-bell me-lg-2"></i>                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Profile updated</h6>
                                <small>15 minutes ago</small>
                            </a>
                          
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">See all notifications</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="{{asset('panel/img/user.jpg')}}" alt="" style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex">{{Auth::guard('admin')->user()->name}}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">My Profile</a>
                            <a href="#" class="dropdown-item">Settings</a>
                            <a href="{{route('admin.logout')}}" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->
                <!-- Rating Submission Form -->
                <form action="{{ route('ratings.store') }}" method="POST">
                    @csrf
                    <div>
                        <label for="rating">Rating:</label>
                        <select name="rating" id="rating">
                            <option value="1">1 Star</option>
                            <option value="2">2 Stars</option>
                            <option value="3">3 Stars</option>
                            <option value="4">4 Stars</option>
                            <option value="5">5 Stars</option>
                        </select>
                    </div>
                    <div>
                        <label for="comment">Comment:</label>
                        <textarea name="comment" id="comment" rows="3"></textarea>
                    </div>
                    <input type="hidden" name="package_id" value="">
                    <button type="submit">Submit Rating</button>
                </form>

                <!-- Display Average Rating -->
                <p>Average Rating: {{ $averageRating }}</p>
            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4 mt-4">
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
