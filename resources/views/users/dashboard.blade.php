@extends('users.layout.app')
@section('title', 'Dashboard')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ _('Profile')}}</h1>
        </div>        

        <div class="section-body">            
            <div class="row mt-sm-4">

                <div class="col-12 col-md-12 col-lg-12">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>Success! </strong> {{ session('success') }}
                        </div>
                    @endif
                    @if (session('fail'))
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>OOPS ! </strong> {{ session('fail') }}
                        </div>
                    @endif
                    @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong style="font-size:15px;">Oops!
                            {{ "Kindly rectify below errors" }}</strong><br/>
                    @foreach ($errors->all() as $error)
                    {{$error }} <br/>
                    @endforeach
                    </div>
                    @endif  
                </div>
                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                        <div class="col-md-4">

                            <!-- Profile Image -->
                            <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                @if($user->profile)
                                <img class="profile-user-img img-fluid img-circle"
                                    src="{{asset('assets/picture/'.$user->profile)}}"
                                    alt="User profile picture" style="height:120px;width:120px;border-radius: 50%;">
                                @else
                                <img class="profile-user-img img-fluid img-circle"
                                    src="{{ asset('assets/image.jpg') }}"
                                    alt="User profile picture" style="height:120px;width:120px;border-radius: 50%;">
                                @endif
                                </div>

                                <h4 class="profile-username text-center">{{$user->name}}</h4>

                                <p class="text-muted text-center">{{$user->role}}</p>
                                <a class="btn btn-outline btn-block" href="mailto:{{$user->email}}"><i class="fas fa-envelope mr-2"></i>{{$user->email}}</a>
                            </div>
                            <!-- /.card-body -->
                            </div>
                            <!-- /.card -->

                            <!-- About Me Box -->
                            <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">About Me</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                            @if($user->department)
                                <strong><i class="fas fa-book mr-1"></i> Department</strong>
                                <p class="text-muted">{{$user->department}}</p>                                
                                @endif
                                @if($user->location)
                                <hr>
                                <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>
                                <p class="text-muted">{{$user->department}}</p>                                
                                @endif
                                @if($user->department)
                                <hr>
                                <strong><i class="fas fa-pencil-alt mr-1"></i> Description</strong>                                
                                <p class="text-muted">{{$user->description}}</p>
                                @else
                                <strong><i class="far fa-file-alt mr-1"></i> Description </strong>
                                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
                                @endif
                                

                                
                            </div>
                            <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-8">
                            <div class="card">
                            <div class="card-header p-2">
                                <ul class="nav nav-pills">                  
                                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Edit Profile</a></li>
                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">                
                                    
                                

                                <div class="active tab-pane" id="settings">
                                    @php

                                        $user_id = $user ? $user->id : "";
                                        $name = $user ? $user->name : "Enter your username";
                                        $description = $user ? $user->description : "Enter description";
                                        $location = $user ? $user->location : "Enter your location";
                                        $department = $user ? $user->department : "Enter your department";
                                    @endphp                                                                                          
                                    <form class="form-horizontal" action="{{ route('editprofile', $user_id ) }}" method="post" enctype="multipart/form-data">
                                        @method('PUT')
                                        @csrf
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                        <div class="col-sm-10">
                                        <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{$name}}" name="name" id="inputName">
                                        </div>
                                    </div>                                           
                                    <div class="form-group row">
                                        <label for="job" class="col-sm-2 col-form-label">Job Description</label>
                                        <div class="col-sm-10">
                                        <textarea class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" id="job" name="description">{{$description}}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="location" class="col-sm-2 col-form-label">Location</label>
                                        <div class="col-sm-10">
                                        <input type="text" name="location" class="form-control{{ $errors->has('location') ? ' is-invalid' : '' }}" placeholder="Enter location" value="{{$location}}" id="location">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="department" class="col-sm-2 col-form-label">Department</label>
                                        <div class="col-sm-10">
                                        <input type="text" name="department" class="form-control{{ $errors->has('department') ? ' is-invalid' : '' }}" placeholder="Enter department" value="{{$department}}" id="department">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="PROFILE" class="col-sm-2 col-form-label">Profile Picture</label>
                                        <div class="col-sm-10">
                                            <input  type="file" class="form-control" accept=".jpg, .jpeg, .JPG, .JPEG, .png, .PNG"  name="profile_picture" id="profile">
                                        </div>
                                    </div>                      
                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->
                                </div>
                                <!-- /.tab-content -->
                            </div><!-- /.card-body -->
                            </div>
                            <!-- /.nav-tabs-custom -->
                        </div>
                        <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div><!-- /.container-fluid -->
                </section>
                <!-- /.content -->
            </div>
        </div>
    </section>


@endsection
@section('script')
    <script></script>
@endsection
