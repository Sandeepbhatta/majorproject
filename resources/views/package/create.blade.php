<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
    <title>Admin panel</title>
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
                            <h6 class="mb-0">{{Auth::guard('admin')->user()->name}}</h6>
                            <!-- <span>SuperAdmin Name : user()->name</span> -->
                        </div>
                    </div>
                        <<a href="{{route('admin.dashboard')}}" class="nav-item nav-link "><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                        <a href="{{route('package.index')}}" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>Package</a>
                        <a href="{{route('category.index')}}" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>Category</a>
                        <a href="{{route('booking.index')}}" class="nav-item nav-link active"><i class="fa fa-table me-2"></i>Booking</a>
                        <a href="{{route('invoice.initiatePayment')}}" class="nav-item nav-link "><i class="fa fa-table me-2"></i>Invoice</a>
                        <a href="{{ route('ratings.index')}}" class="nav-item nav-link "><i class="fa fa-table me-2"></i>Ratings & Reviews</a>


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
                <!-- <form class="d-none d-md-flex ms-4">
                    <input class="form-control bg-dark border-0" type="search" placeholder="Search">
                </form> -->
                <div class="navbar-nav align-items-center ms-auto">
                    <!-- <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-envelope me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Message</span>
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
                    </div> -->
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="{{asset('panel/img/user.jpg')}}" alt="" style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex">{{Auth::guard('admin')->user()->name}}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <!-- <a href="#" class="dropdown-item">My Profile</a>
                            <a href="#" class="dropdown-item">Settings</a> -->
                            <a href="{{route('admin.logout')}}" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->
            <!-- Modal -->
            <!-- <button type="submit" class="btn btn-info py-3 w-5 mb-2 col-xl-3" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Booking</button> -->

               <!-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"> -->
                    <form action="{{route('package.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-dialog " >
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                            <div class="modal-content ">
                                <div class="modal-header" >
                                    <h5 class="modal-title" id="model-title" style="Color:Black">Create Package</h5>
                                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                                </div>
                                <div class="modal-body ">
                                    <div class="form-group md-4">
                                        <label for="name" class="form-label">Package Name</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"   name="name" placeholder="Name" value="{{old('name')}}" style="background:white;">
                                        @error('name')
                                        <p class="valid-feedback text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group md-4">
                                        <label for="price" class="form-label">Price</label>
                                        <input type="number" class="form-control @error('Price') is-invalid @enderror" name="price" placeholder="Price" value="{{ old('Price') }}" style="background:white;">
                                        @error('Price')
                                            <p class="valid-feedback text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group md-4">
                                        <label for="discount" class="form-label">Discount</label>
                                        <input type="number" class="form-control @error('number') is-invalid @enderror"   name="discount" placeholder="Discount" value="{{old('discount')}}" style="background:white;">
                                        @error('discount')
                                        <p class="valid-feedback text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group md-4">
                                        <label for="description" class="form-label"></label>
                                        <input type="text" size="100"class="form-control @error('date') is-invalid @enderror"  name="description" placeholder="Description" value="{{old('description')}}" style="background:white;">
                                        @error('description')
                                        <p class="valid-feedback text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group my-1 py-2">
                                        <label class="form-label">Features</label><br>
                                        <input type="checkbox" name="features[]" checked value="Decoration and Design">Decoration and Design<br>
                                        <input type="checkbox"value="Customized Theme"  checked  name="features[]"  value="Customized Theme">Customized Theme <br>
                                    </div>
                                    <div class="form-group md-3 "  >
                                    <label for ="form" class="form-label">Select Category</label>
                                    <select class="form-control"name="category_id" required>
                                        <option value="">Select a Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            
                                        @endforeach
                                    </select>
                                    </div>

                                    <div>
                                        <label for="image" class="form-label">Upload Image:</label>
                                        <input type="file" name="image" class="@error('image') is-invalid @enderror">    
                                        @error('image')
                                        <p class="valid-feedback text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <a href="{{route('package.index')}}" class="btn btn-secondary">Back</a>
                                    <input type="submit" class="btn btn-primary" value="Save">
                                </div>
                            </div>
                        </div>
                    </form>
            <!-- pop up model end -->
            <!-- Footer Start -->
            <!-- <div class="container-fluid pt-4 px-4 mt-4">
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
            </div> -->
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
