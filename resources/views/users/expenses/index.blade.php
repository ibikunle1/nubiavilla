@extends('users.layout.app')
@section('title', 'Dashboard')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ _('Expenses Manager')}}</h1>
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
            </div>
        </div>

        <div class="card card-default">
        <div class="card-header">
            <h5 class="card-title">Manage Expenses</h5>
        </div>      
          <!-- /.card-header -->
            <div class="card-body table-responsive">
                @if($expenses)                
                <table id="example1" class="table table-bordered">
                    <thead>
                        <tr>                            
                            <th>Date</th>
                            <th>Merchant</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>comment</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php
                    $i=1;                    
                    @endphp
                    @foreach($expenses as $expense)
                    <tr>
                        <td>{{$expense->date->format('Y-m-d')}}</td>
                        <td>{{$expense->merchant}}</td>
                        <td>${{$expense->total}}</td>                                               
                        <td>{{$expense->status}}</td>
                        <td>{{$expense->comment}}</td></a>
                        <td>
                            <a href="#{{ $expense->merchant }}{{$expense->id}}" data-toggle="modal"><span class="btn btn-info"><i class="fa fa-edit"></i></span></a> ||
                            <form action="{{route('expenses.destroy', $expense->id)}}" method="post" id="delete-form{{$expense->id}}" style="display:none">
                                @csrf
                                @method('delete')                                
                            </form>
                            <button onclick="if(confirm('Are you sure you want to delete this expense?')){
                            event.defaultPrevented;
                            document.getElementById('delete-form{{$expense->id}}').submit();
                            } else{
                                event.defaultPrevented;
                            }" class="btn btn-danger" ><i class="fas fa-trash-alt"></i></button>
                        </td>
                    </tr>  
                    @endforeach                  
                    </tbody>                    
                </table>
            
                @else
                No expense Available
                @endif
            </div>       
    </div>
    <button class="btn btn-primary float-right mr-5" style="border-radius: 20px; width:40px; height:40px" type="button" data-toggle="modal" data-target="#addExpenses"><i class="fa fa-plus"></i></button>
    </section>


@endsection

<div class="modal fade" id="addExpenses">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
    
      <form action="{{route('expenses.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-header">
          <h4 class="modal-title">Add Expenses</h4>          
        </div>
        
        <!-- Modal body -->
        <div class="modal-body ">        
            <div class="form-group row">
                <label for="merchant" class="col-sm-2 col-form-label">Merchant</label>
                <div class="col-sm-10">
                <select class="custom-select" name="merchant" id="merchant">
                    <option value=""></option>
                    <option value="Office Supply">Office supply</option>
                    <option value="Resturant">Resturant </option>
                    <option value="Hotel">Hotel</option>
                    <option value="Airline">Airline</option>
                    <option value="breakfast">Breakfast</option>
                </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="total" class="col-sm-2 col-form-label">Total</label>
                <div class="col-sm-10">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">$</span>
                    </div>
                    <input type="text" name="total" class="form-control{{ $errors->has('total') ? ' is-invalid' : '' }}" placeholder="Total">
                    </div> 
                </div>
            </div>
            <div class="form-group row">
                <label for="date" class="col-sm-2 col-form-label">Date</label>
                <div class="col-sm-10">
                <input type="date" class="form-control{{ $errors->has('date') ? ' is-invalid' : '' }}" name="date" id="date">
                </div>
            </div>
            <div class="form-group row">
                <label for="comment" class="col-sm-2 col-form-label">Comment</label>
                <div class="col-sm-10">                                        
                <textarea class="form-control{{ $errors->has('comment') ? ' is-invalid' : '' }}" id="comment" name="comment"></textarea>                
                </div>
            </div>
            <div class="form-group row">
                <label for="receipt" class="col-sm-2 col-form-label">Select receipt</label>
                <div class="col-sm-10">
                    <input  type="file" class="form-control" accept=".jpg, .jpeg, .JPG, .JPEG, .png, .PNG"  name="receipt" id="receipt">
                </div>
            </div>            
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
        </div>
      </form>
        
      </div>
    </div>
</div>

@foreach($expenses as $expense)
<div class="modal fade" id="{{ $expense->merchant }}{{ $expense->id }}">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
    
      <form action="{{route('expenses.update', $expense->id )}}" method="post" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="modal-header">
          <h4 class="modal-title">Add Expenses</h4>          
        </div>
        
        <!-- Modal body -->
        <div class="modal-body ">        
            <div class="form-group row">
                <label for="merchant" class="col-sm-2 col-form-label">Merchant</label>
                <div class="col-sm-10">
                <select class="custom-select" name="merchant" id="merchant">
                    <option value="{{ $expense->merchant }}">{{ $expense->merchant }}</option>
                    <option value="Office Supply">Office supply</option>
                    <option value="Resturant">Resturant </option>
                    <option value="Hotel">Hotel</option>
                    <option value="Airline">Airline</option>
                    <option value="breakfast">Breakfast</option>
                </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="total" class="col-sm-2 col-form-label">Total</label>
                <div class="col-sm-10">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">$</span>
                    </div>
                    <input type="text" name="total" class="form-control{{ $errors->has('total') ? ' is-invalid' : '' }}" value="{{ $expense->total }}">
                    </div> 
                </div>
            </div>
            <div class="form-group row">
                <label for="date" class="col-sm-2 col-form-label">Date</label>
                <div class="col-sm-10">
                <input type="date" class="form-control{{ $errors->has('date') ? ' is-invalid' : '' }}" name="date" value="{{$expense->date->format('Y-m-d')}}" id="date">
                </div>
            </div>
            <div class="form-group row">
                <label for="comment" class="col-sm-2 col-form-label">Comment</label>
                <div class="col-sm-10">                                        
                <textarea class="form-control{{ $errors->has('comment') ? ' is-invalid' : '' }}" id="comment" name="comment">{{ $expense->comment }}</textarea>                
                </div>
            </div>
            <div class="form-group row">
                <label for="receipt" class="col-sm-2 col-form-label">Select receipt</label>
                <div class="col-sm-10">                    
                    <input  type="file" class="form-control" accept=".jpg, .jpeg, .JPG, .JPEG, .png, .PNG"  name="receipt" value="{{ $expense->recipt }}" id="receipt">
                </div>
            </div>            
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
        </div>
      </form>
        
      </div>
    </div>
</div>
@endforeach


@section('script')
<script type="text/javascript">
    $(document).ready(function () {
      bsCustomFileInput.init();
    });
    </script>
    <script>
        $(function () {
          $("#example1").DataTable();        
        });
    </script>
@endsection