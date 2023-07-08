@extends('admin.admin_master')
@section('admin')
<!-- Modal -->
<!-- <button type="submit" class="btn btn-info py-3 w-5 mb-2 col-xl-3" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Booking</button> -->

<!-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"> -->
<form action="{{route('admin.update',$admin->id)}}" method="post" enctype="multipart/form-data">
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
                <h5 class="modal-title" id="model-title" style="Color:Black">Admin</h5>
                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
            </div>
            <div class="modal-body ">
                <div class="form-group md-4">
                    <label for="name" class="form-label">Admin Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror"   name="name" placeholder="Name" value="{{old('name',$admin->name)}}" style="background:white;">
                    @error('name')
                    <p class="valid-feedback">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group md-4">
                    <label for="email" class="form-label"></label>
                    <input type="text" size="100"class="form-control @error('date') is-invalid @enderror"  name="email" placeholder="Email" value="{{old('email',$admin->email)}}" style="background:white;">
                    @error('description')
                    <p class="valid-feedback">{{$message}}</p>
                    @enderror
                </div>
                
            </div>
            <div class="modal-footer">
                <a href="{{route('admin.index')}}" class="btn btn-secondary">Back</a>
                <input type="submit" class="btn btn-primary" value="Save">
            </div>
        </div>
    </div>
</form>
<!-- pop up model end -->
@endsection