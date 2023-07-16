@extends('admin.admin_master')
@section('admin')
<form action="{{route('admin.store')}}" method="post" enctype="multipart/form-data">
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
                <h5 class="modal-title" id="model-title" style="Color:Black">Admin</h5>
                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
            </div>
            <div class="modal-body ">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('name') is-invalid @enderror"   name="name" placeholder="Name" value="{{old('name')}}" style="background:white;">
                    <label for="name" class="form-label">Admin Name</label>

                    @error('name')
                    <p class="valid-feedback">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="text" size="100"class="form-control @error('email') is-invalid @enderror"  name="email" placeholder="Email" value="{{old('email')}}" style="background:white;">
                    <label for="email" class="form-label">Email</label>

                    @error('email')
                    <p class="valid-feedback">{{$message}}</p>
                    @enderror
                </div>

                <div class="form-floating mb-3">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" style="background:white;">
                            <label for="password">Password</label>
                            @error('password')
                            <p class="invalid-feedback">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" placeholder="Confirm Password" style="background:white;">
                            <label for="password_confirmation">Confirm Password</label>
                            @error('password_confirmation')
                            <p class="invalid-feedback">{{$message}}</p>
                            @enderror
                        </div>
                                
            </div>
            <div class="modal-footer">
                <a href="{{route('admin.dashboard')}}" class="btn btn-secondary">Back</a>
                <input type="submit" class="btn btn-primary" value="Save">
            </div>
        </div>
    </div>
</form>
@endsection