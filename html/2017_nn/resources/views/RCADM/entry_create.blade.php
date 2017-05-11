@extends('boot.layout')

@section('content')

<form class="navbar-form navbar-left" method="post" action="{{route('rcadm.store')}}">     
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="btn-group btn-group-justified" role="group" aria-label="...">
        <div class="btn-group" role="group">
            <input type="text" class="form-control" value="{{ $_GET['cif'] or old('cif') }}"  placeholder="CIF" name="cif" id="cif" />
        </div>
        <div class="btn-group" role="group">
            <input type="text" value="{{ $_GET['id_aplicatie'] or old('id_aplicatie') }}" class="form-control" placeholder="ID Aplicatie" name="id_aplicatie" id="id_aplicatie">
        </div>
        <div class="btn-group" role="group">
            <span class="label label-info">Data Semnare:</span>
            <input value="{{$_GET['data_semnare'] or old('data_semnare')}}" class="form-control datepicker" placeholder="Data Semnare" name="data_semnare" id="data_semnare" >  
        </div>
        <div class="btn-group" role="group">
            <div class="btn-group input-group" role="group">
                <button type="submit" class="btn btn-primary"><?=empty($pachet->total())?'Creaza pachet':'Adauga'?></button>
                @if(!empty($pachet->total()))
                <div class="input-group-btn">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="caret"></span></button>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li>{{ link_to_route('pachet.edit' ,'Close', [$pachet->first()->pachet] , ['class' => 'btn btn-danger']) }}</li>
                    </ul>
                </div>
                @endif
            </div>
        </div>
    </div>
    <div class="content" >        
        @include('RCADM.entry_createFields')
    </div>
</form>


<script type="text/javascript" >
    window.onload=function(){
        $('form a.produs').click(function() {            
            new_url = ( this.href + '&cif=' +  $('#cif').val() + '&id_aplicatie=' +  $('#id_aplicatie').val() + '&data_semnare=' +  $('#data_semnare').val() );
            window.location.replace(new_url);
            return false;
        });    
    }
</script>

@push('scripts')  
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script type="text/javascript">
  $(function() {
      
    $( ".datepicker" ).datepicker({
      changeMonth: true,
      changeYear: true,
      defaultDate: getCookie("old_month"), 
      dateFormat: "yy-mm-dd"
    });
    
    
    $( "#data_semnare" ).change(function() {
        
        // old date
        var old = $('#data_semnare').val();
        
        var o = new Date( old );        
        var om = o.getMonth();    
        // new date
        var n = new Date();
        var nm = n.getMonth();
        
        var future = (om - nm) + "m "  ;        
        //document.cookie="old_month="+future;
        
        var exp = new Date();
        exp.setTime(exp.getTime() + ( 60*60*1000) );
        var expires = "expires="+exp.toUTCString();
        //document.cookie = "old_month="+future + "; " + expires;
        
        document.cookie = "old_month="+old + "; " + expires;
        
      });    
  });
  
        function getCookie(cname) {
          var name = cname + "=";
          var ca = document.cookie.split(';');
          for(var i=0; i<ca.length; i++) {
              var c = ca[i];
              while (c.charAt(0)==' ') c = c.substring(1);
              if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
          }
          return "";
      }
  </script>
@endpush 

<!-- Entry that have been inserted to current Pack -->    
<hr>

    <table id="pachet_curent" class="table table-condensed" width="100%">
        <thead>
            <tr>                
                <td></td>
                <th>CIF</th>                
                <th>Produs</th>
                <th>Document</th>
                <th>ID aplicatie</th>
                <th>Data Semnare</th>
            </tr>
        </thead>          
        @foreach ($pachet as $entry)
        <tr>                    
            <td>
                {{ Form::open(['route' => ['rcadm.destroy', $entry ], 'method' => 'delete']) }}                   
                    {{ Form::submit('Sterge', ['class' => 'btn btn-danger btn-xs']) }}
                {{ Form::close() }}
            </td>
            </td>
            <td>{{ $entry->cif }}</td>            
            <td>{{ $entry->produs->descriere }}</td>
            <td>{{ $entry->document->descriere }}</td>
            <td>{{ $entry->id_aplicatie }}</td>
            <td>{{ $entry->data_semnare }}</td>
        </tr>
        @endforeach
    </table>

@endsection