<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
    <title>SuperAdmin panel</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <!-- <meta name="csrf-token" content="{{ csrf_token() }}" /> -->


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
                            <h6 class="mb-0">Jhon Doe</h6>
                            <!-- <span>SuperAdmin Name : user()->name</span> -->
                        </div>
                    </div>
                    <div class="navbar-nav w-100">
                        <a href="{{route('booking.index')}}" class="nav-item nav-link "><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                        <a href="form.html" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>Package</a>
                        <a href="" class="nav-item nav-link active"><i class="fa fa-table me-2"></i>Booking</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="far fa-file-alt me-2"></i>Create</a>
                            <div class="dropdown-menu bg-transparent border-0">
                                <a href="{{route('admin.register')}}" class="dropdown-item">Sign Up</a>
                            </div>
                        </div>
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
                <form class="d-none d-md-flex ms-4">
                    <input class="form-control bg-dark border-0" type="search" placeholder="Search">
                </form>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-envelope me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Message</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="{{asset('panel/img/user.jpg')}}" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
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
                            <i class="fa fa-bell me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Notificatin</span>
                        </a>
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
                            <span class="d-none d-lg-inline-flex">John Doe</span>
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


            <!-- Table Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-14">
                    <a href="{{route('package.create')}}" class="btn btn-info py-3 w-5 mb-2 col-xl-3">Add Pacakge</a> 
                    <div class="col-sm-12 ">
                        <div class="bg-secondary rounded h-100 p-4">
                            @if(Session::has('success'))
                            <div class="alert alert-success">
                                {{Session::get('success')}}
                            </div>
                            @endif
                            <h6 class="mb-4">Package List</h6>
                            <table class="table table-hover" id="package-table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Booking Date</th>
                                        <th scope="col">AD Payment Status</th>
                                        <th scope="col">Package</th>
                                        <th scope="col">Start Date</th>
                                        <th scope="col">End Date</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    @if( $packages->isNOtEmpty() )
                                    @foreach( $packages as $package )
                                    <tr>
                                        <td scope="col">{{ $package->id }}</td>
                                        <td scope="col">{{ $package->name }}</td>
                                        <td scope="col">{{ $package->package_date }}</td>
                                        <td scope="col">{{ $package->price_status }}</td>
                                        <td scope="col">{{ $package->package_type }}</td>
                                        <td scope="col">{{ $package->start_date}}</td>
                                        <td scope="col">{{ $package->end_date}} </td>
                                        <td>
                                            <a href="{{ route('package.edit',$package->id) }}" class="btn btn-info" >Edit</a>
                                            <a href="#" onClick="deletepackage({{$package->id}})" class="btn btn-primary">Delete</a>
                                            <form id="package-edit-action-{{$package->id}}" action="{{route('package.destroy',$booking->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <!-- <a class="btn btn-danger"  type="submit">Delete</a> -->
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                    
                                    @else
                                    <tr>
                                        <tdcolspan="6">Record Not Found</td>
                                    </tr>

                                    @endif
                                </thead>
                            </table>
                        </div>
                        <div class="mt-3">
                            {{ $packages->links() }}
                        </div>
                    </div>
                </div>
            </div>
            <!-- Table End -->
            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4 ">
                <div class="bg-secondary rounded-top p-4 mt-3">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start ">
                            &copy; <a href="#">Your Site Name</a>, All Right Reserved. 
                        </div>
                        <div class="col-12 col-sm-6 text-center text-sm-end">
                            <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                            Designed By <a href="https://htmlcodex.com">HTML Codex</a>
                            <br>Distributed By: <a href="https://themewagon.com" target="_blank">ThemeWagon</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End -->
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.js"></script>


    <!-- Template Javascript -->
    <script src="{{asset('panel/js/main.js')}}"></script>

</body>

</html>
<script>
    function deletePackage(id){
        if(confirm("Are you sure you want to delete?")){
           document.getElementById('package-edit-action-' + id).submit(); 
        }
    }
</script>