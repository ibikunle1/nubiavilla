@extends('users.layout.app')
@section('title', 'Dashboard')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ _('Import Expenses')}}</h1>
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
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>OOPS ! </strong> {{ session('error') }}
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
            </div>
        </div>

        <div class="card card-default">
        <div class="card-header">
            <h5 class="card-title">Import Expenses</h5>
        </div>      
          <!-- /.card-header -->
            <div class="card-body">
                <form action="{{route('import')}}" method="post" enctype="multipart/form-data">                    
                    @csrf
                    <div class="form-group">
                        <label for="import">Import file</label>                        
                        <input  type="file" class="form-control" accept=".csv,.CSV"  required name="file" id="import">                        
                    </div> 
                    <button type="submit" class="btn btn-primary float-right">Import Expenses</button>            
                    <div class="clearfix"></div>
                </form>
               
            </div>       
    </div>    
    </section>




@endsection
