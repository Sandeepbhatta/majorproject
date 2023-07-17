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
    <script src="https://khalti.s3.ap-south-1.amazonaws.com/KPG/dist/2020.12.17.0.0.0/khalti-checkout.iffe.js"></script>

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
                            <h6 class="mb-0"></h6>
                            <!-- <span>SuperAdmin Name : </span> -->
                        </div>
                    </div>
                    <div class="navbar-nav w-100">
                        <a href="{{route('admin.dashboard')}}"  class="nav-item nav-link "><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                        <a href="{{route('package.index')}}" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>Package</a>
                        <a href="{{route('category.index')}}" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>Category</a>
                        
                        <a href="{{route('booking.index')}}" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Booking</a>
                        <a href="{{route('invoice.payment')}}" class="nav-item nav-link active"><i class="fa fa-table me-2"></i>Invoice</a>
                        <a href="" class="nav-item nav-link "><i class="fa fa-table me-2"></i>Ratings & Reviews</a>

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
                                        <h6 class="fw-normal mb-0"></h6>
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
                                        <h6 class="fw-normal mb-0"></h6>
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
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">New user added</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Password changed</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">See all notifications</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="{{asset('panel/img/user.jpg')}}" alt="" style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex"></span>
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
            <body>
            <div class="container-fluid pt-4 px-4">
            <div class="row g-14">
            <div class="text-center text-sm-end">
                <h5 class="modal-title" id="model-title" style="Color:Black">Wallet Payment</h5>
                <button id="payment-button">Pay with Khalti</button>
            <script>
                    var config = {
                        // replace the publicKey with yours
                        "publicKey": "{{config('app.khalti_public_key')}}",
                        "productIdentity": "1234567890",
                        "productName": "Dragon",
                        "productUrl": "http://gameofthrones.wikia.com/wiki/Dragons",
                        "paymentPreference": [
                            "KHALTI",
                            "EBANKING",
                            "MOBILE_BANKING",
                            "CONNECT_IPS",
                            "SCT",
                            ],
                        "eventHandler": {
                            onSuccess (payload) {
                                $.ajax({
                                    type:'POST',
                                    url:"{{route('khalti.verifyPayment')}}",
                                    data:{
                                        token : payload['token'],
                                        amount: payload.amount,
                                        "_token" : "{{csrf_token()}}"
                                    }
                                    success : function(res){
                                        $.ajax({
                                            type: "POST",
                                            url: "{{route('khalti.storePayment')}}",
                                            data:{
                                                response : res,
                                                _token :"{{ csrf_token()}}",
                                                paymentMethodId : 'Khalti',
                                                status : true,
                                               referenceNumber : '',
                                                paidAmount : '',


                                            }
                                        })
                                        console.log(res);

                                    }
                                });
                                // hit merchant api for initiating verfication
                                console.log(payload);
                            },
                            onError (error) {
                                console.log(error);
                            },
                            onClose () {
                                console.log('widget is closing');
                            }
                        }
                    };

                    var checkout = new KhaltiCheckout(config);
                    var btn = document.getElementById("payment-button");
                    btn.onclick = function () {
                        // minimum transaction amount must be 10, i.e 1000 in paisa.
                        checkout.show({amount: 100000});
                    }
            </script>
                           <!-- Table Start -->
        <div class="container-fluid pt-4 px-4">
        <div class="row g-14">
            <div class="text-center text-sm-end">
                <a href="{{ route('invoice.payment') }}" class="btn btn-info py-3 w-5 mb-2 col-xl-2" >Add Payment</a> 
            </div>
            <div class="col-sm-12 ">
                <div class="bg-secondary rounded h-100 p-4">
                    @if(Session::has('success'))
                    <div class="alert alert-success">
                        {{Session::get('success')}}
                </div>
                    @endif
                    <h6 class="mb-4">Payment List</h6>
                    <table class="table table-hover" id="booking-table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Email</th>
                                <th scope="col">Payment Amount</th>
                                <th scope="col"></th>
                                <th scope="col">Package</th>
                                <th scope="col">Booking Type</th>
                                <th scope="col"></th>
                                <th scope="col">Action</th>
                            </tr>
                            @if( $invoice->isNOtEmpty() )
                            @foreach( $invoice as $invoice )
                            <tr>
                                <td scope="col">{{ $invoice->id }}</td>
                                <td scope="col">{{ $invoice->email }}</td>
                                <td scope="col">{{ $invoice->Payment_Amount }}</td>
                                <td scope="col">{{ $invoice->package }}</td>
                                <td scope="col">{{ $invoice->booking}}</td>
                                <td>
                                    <a href="{{ route('invoice.edit',$invoice->id) }}" class="btn btn-info" >Edit</a>
                                    <a href="#" onClick="deleteinvoice({{$invoice->id}})" class="btn btn-primary">Delete</a>
                                    <form id="invoice-edit-action-{{$invoice->id}}" action="{{route('invoice.destroy',$invoice->id)}}" method="post">
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
