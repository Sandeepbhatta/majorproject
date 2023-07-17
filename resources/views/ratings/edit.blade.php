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


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <!-- Navbar End -->
            <!-- Modal -->
            <!-- <button type="submit" class="btn btn-info py-3 w-5 mb-2 col-xl-3" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Booking</button> -->

               <!-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"> -->
               <form action="{{route('package.update',$package->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
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
                                    <h5 class="modal-title" id="model-title" style="Color:Black">Edit Package</h5>
                                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                                </div>
                                <div class="modal-body ">
                                    <div class="form-group md-4">
                                        <label for="name" class="form-label">Package Name</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"   name="name" placeholder="Name" value="{{old('name',$package->name)}}" style="background:white;">
                                        @error('name')
                                        <p class="valid-feedback">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group md-4">
                                        <label for="price" class="form-label">Price</label>
                                        <input type="number" class="form-control @error('Price') is-invalid @enderror" name="price" placeholder="Price" value="{{ old('Price',$package->price) }}" style="background:white;">
                                        @error('Price')
                                            <p class="valid-feedback">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group md-4">
                                        <label for="discount" class="form-label">Discount</label>
                                        <input type="number" class="form-control @error('number') is-invalid @enderror"   name="discount" placeholder="Discount" value="{{old('discount',$package->discount)}}" style="background:white;">
                                        @error('discount')
                                        <p class="valid-feedback">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group md-4">
                                        <label for="description" class="form-label"></label>
                                        <input type="text" size="100"class="form-control @error('date') is-invalid @enderror"  name="description" placeholder="Description" value="{{old('description',$package->description)}}" style="background:white;">
                                        @error('description')
                                        <p class="valid-feedback">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group my-1 py-2">
                                        <label class="form-label">Features</label><br>
                                        <input type="checkbox" name="features[]" checked value="Decoration and Design">Decoration and Design<br>
                                        <input type="checkbox"value="Customized Theme"  checked  name="features[]"  value="Customized Theme">Customized Theme <br>
                                    </div>

                                    <div>
                                    <label for="image" class="form-label">Upload Image:</label>
                                    <input type="file" name="image" class="@error('image') is-invalid @enderror">    
                                    @error('image')
                                     <p class="valid-feedback">{{$message}}</p>
                                    @enderror
                                </div>
                                </div>
                                <div class="modal-footer">
                                    <a href="{{route('package.index')}}" class="btn btn-secondary">Back</a>
                                    <button class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
            <!-- pop up model end -->
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
