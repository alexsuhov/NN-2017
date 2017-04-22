@inject('users', '\App\User')
@inject('pachete', 'App\modules\DataEntry\Pachet')


<?php
$rows = $pachete->orderBy('id_pachet', 'desc')
        ->where(isset($_GET['user'])?['user_id' => $_GET['user']]:[])
        ->where(isset($_GET['pachet'])?['id_pachet' => $_GET['pachet']]:[])
                ->withCount('entry')        
                ->withCount('arhiva')         
                ->paginate(30)
?>
<ol class="breadcrumb">
  <li>Home</li>
  <li class="active">Pachete</li>
</ol>

<div >
{{ $rows->appends(isset($_GET['user'])?['user' => $_GET['user']]:[])->links() }}
</div>
<table  class="table table-striped table-condensed" >    
    <thead>
        <tr>
            <th>
                <form class="form-inline">
                    <input type="number" class="form-control" placeholder="Id Pachet" name="pachet" >
                    <button type="submit" class="btn btn-default">Cauta</button>
                </form>
                ID Pachet
            </th>
            <th width="150px">                   
                <select id="select_user" class="form-control">
                    <option value="clear">...</option>
                    <option value="" <?=isset($_GET['user'])?"selected":""?> > #n/a </option>
                    @foreach ( $users->orderBy("name")->get() as $user )
                    <option value="{{ $user->id_user or 0 }}" <?=(isset($_GET['user']) && $_GET['user']==$user->id_user )?"selected":""?> >{{ $user->name or 'no' }}</option>
                    @endforeach
                </select>
                User: 
            </th>
            <th style="text-align: center" >
                Cif <br />Count
            </th>
            <th style="text-align: center">
                Doc <br /> Count 
            </th>
            <th style="text-align: center">
                Arhiva <br /> Count 
            </th>
            <th style="text-align: center">
                Scan <br /> Count 
            </th>
            <th>
                Genereaza <br /> Etichete
            </th>
        </tr>
    </thead>
    @foreach ( $rows as $pachet )        
    <tr>
        <td>            
            <a href="{{url('list/search')."?pachet=".$pachet->id_pachet}}">{{$pachet->created_at}}</a>
            : {{$pachet->id_pachet}}
        </td>
        <td>
            {{ $pachet->User->name or "#n/a" }}
            @if( $pachet->is_etichete_generated == -1)            
            {{ link_to_route('pachet.edit' ,'Close', [$pachet] , ['class' => 'btn btn-danger']) }}
            @endif            
        </td>
        <td align="right" style="padding-right: 50px">
            {{ $pachet->entry->groupBy('cif')->count() }}                
        </td>
        <td align="right" style="padding-right: 50px">
            {{ $pachet->entry_count }}           
        </td>
        <td>
            {{ $pachet->arhiva_count }}
        </td>
        <td>
            {{ $pachet->scan->count() }}
        </td>
        <td>
            @if( $pachet->is_etichete_generated != -1 && $pachet->entry_count != 0)
            {{ link_to_route('pachet.show' ,'2D', [$pachet] , ['class' => 'btn btn-success' , "target"=>"_blank"]) }}            
            @endif
        </td>    
    </tr>
    @endforeach
</table>

@push('scripts')            
       <script type="text/javascript">    
        $(document).ready(function() {
            $('#select_user').change( function() {
                if($(this).val() != 'clear')
                     location.href = window.location.href.split('?')[0]+"?user="+$(this).val();      
                else location.href = window.location.href.split('?')[0];
            return false;
      });        
    });
    </script>
@endpush

