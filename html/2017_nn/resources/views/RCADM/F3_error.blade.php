@extends('boot.layout')

@section('content')
<ol class="breadcrumb">
  <li>Home</li>
  <li><a href="#">Flow3 scan</a></li>
  <li class="active">Erori</li>
</ol>

<form  method="post" enctype="multipart/form-data" style="width: 200px">
    {{ csrf_field() }}
Log: <input type="file" name="file" /><br />
    <div class="form-group has-success has-feedback">
        <label class="control-label" for="inputSuccess4" >Data:</label>
        <input name="data" type="date" class="form-control" id="inputSuccess4" aria-describedby="inputSuccess4Status">
    </div>
    <div class="form-group has-success has-feedback">
        <label class="control-label" for="inputGroupSuccess3">Cutie:</label>
        <div class="input-group">
            <span class="input-group-addon">T</span>
            <input name="cutie" type="text" class="form-control" id="inputGroupSuccess3" aria-describedby="inputGroupSuccess3Status">
        </div>    
    </div>    
    <input type="submit">
</form>

@if(isset($_POST['data']))
@include('RCADM.F3_error_back')
@endif

@endsection