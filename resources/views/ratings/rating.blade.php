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
               <!-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"> -->
               <form method="POST" action="{{ route('ratings.add') }}">
    @csrf

    <input type="hidden" name="package_id" value="{{ $package->id }}">

    <div class="form-group">
        <label for="rating">Rating:</label>
        <select name="rating" id="rating" class="form-control">
            <option value="1">1 Star</option>
            <option value="2">2 Stars</option>
            <option value="3">3 Stars</option>
            <option value="4">4 Stars</option>
            <option value="5">5 Stars</option>
        </select>
    </div>

    <div class="form-group">
        <label for="review">Review:</label>
        <textarea name="review" id="review" class="form-control"></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Submit Rating</button>
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
