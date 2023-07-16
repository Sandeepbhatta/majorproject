    @extends('admin.admin_master')
    @section('admin')
            <!-- Sale & Revenue Start -->
            <div class="container-fluid pt-4 px-4">
                @if(Session::has('error'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>{{session::get('error')}}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                @endif
                <!-- <h4>Login Admin Name : {{Auth::guard('admin')->user()->name}}</h4> -->
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-line fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Today Sale</p>
                                <h6 class="mb-0">$1234</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-bar fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total Sale</p>
                                <h6 class="mb-0">$1234</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-area fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Today Revenue</p>
                                <h6 class="mb-0">$1234</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-pie fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total Revenue</p>
                                <h6 class="mb-0">$1234</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Table Start -->
            @if(Auth::guard('admin')->user()->role == "superadmin")
            <div class="container-fluid pt-4 px-4">
                <div class="row g-14">
                    <!-- <div class="text-center text-sm-end">
                    <a href="{{ route('admin.create') }}" class="btn btn-info py-3 w-5 mb-2 col-xl-3 ">Add Admin</a> 
                    </div> -->
                    <div class="col-sm-12 ">
                        <div class="bg-secondary rounded h-100 p-4">
                            @if(Session::has('success'))
                            <div class="alert alert-success">
                                {{Session::get('success')}}
                            </div>
                            @endif
                            <h6 class="mb-4">Admin List</h6>
                            <table class="table table-hover" id="admin-table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Role</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    @if( $admins->isNOtEmpty() )
                                    @foreach( $admins as $admin )
                                    <tr>
                                        <td scope="col">{{ $admin->id }}</td>
                                        <td scope="col">{{ $admin->name }}</td>
                                        <td scope="col">{{ $admin->email }}</td>
                                        <td scope="col">{{ $admin->role}}</td>
                                        <td>
                                            <a href="{{ route('admin.edit',$admin->id) }}" class="btn btn-info" >Edit</a>
                                            @if(Auth::guard('admin')->user()->role !=  $admin->role)
                                                <a href="#" onClick="deleteAdmin({{$admin->id}})" class="btn btn-primary">Delete</a>
                                                <form id="admin-edit-action-{{$admin->id}}" action="{{route('admin.destroy',$admin->id)}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <!-- <a class="btn btn-danger"  type="submit">Delete</a> -->
                                                </form>
                                            @endif
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
                            {{ $admins->links() }}
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <!-- Table End -->
            <script>
                function deleteAdmin(id){
                    if(confirm("Are you sure you want to delete?")){
                    document.getElementById('admin-edit-action-' + id).submit(); 
                    }
                }
            </script>
@endsection