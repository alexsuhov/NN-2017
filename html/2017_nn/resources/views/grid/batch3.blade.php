@inject('batch', 'App\modules\DataEntry\Batch')
@inject('arhiva', 'App\modules\DataEntry\EntryArhiva')

<a href="<?=url('sync')?>">Sync</a>

<table class="table" >
    <thead>
        <tr>
            <th>Batch LIVE</th>
            <th>Cutie</th>
            <th>alerts</th>
            <th width="50 px">
                <input type="checkbox" class="form-control check_all" >
            </th>
            <th>
                <button type="button" class="btn btn-warning do_all">Move</button>
            </th>
        </tr>
    </thead>
    @foreach ( $batch
            ->select('batch' ,'cutie')
            ->groupBy('batch','cutie')
            ->get() 
            as $cutie )
    <tr>
        <td>
            {{ $cutie->batch }}
        </td>
        <td>
            {{ $cutie->cutie }}      
        </td>
        <td>
            scan:{{ $batch->where('batch' ,$cutie->batch )->count()  }}
        </td>
        <td  align="center">
            <input type="checkbox" class="check_one" name="batch[]" value="{{$cutie->batch}}">
        </td>
        <td>
            <a href="{{route('scan.show' , $cutie->batch )}}" title="il muta in arhiva">Move it</a>
        </td>        
    </tr>
    @endforeach
</table>
<?php $rows = $arhiva->orderBy('id_batch','desc')->paginate(10) ?>
{{ $rows->links() }}

<a name="arhiva"></a> 
<table class="table" >
    <thead>
        <tr>
            <th>Batch</th>
            <th>Cutie</th>   
            <th>Doc Count</th>
            <th width="50 px" style="display: none">
                <input type="checkbox" class="form-control check_all" >
            </th>
            <th colspan="2">
                Actions
            </th>
        </tr>
    </thead>
    @foreach ( $rows as $b )
    <tr>        
        <td>           
            <a href="{{url('list/search')."?batch=$b->id_batch"}}" >{{ $b->batch_name }}</a>
        </td>
        <td onclick="javascript:edit_cutie({{$b->id_batch}})" id="B{{$b->id_batch}}">
            <span class="badge" >{{ $b->skp_serie }}</span>
            <span>{{ $b->skp_id }}</span>
            <form action="{{route('scan.update',[$b])}}" style="display: none" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input value="<?=$b->skp_id?>" name="skp_id" >
                <input type="submit" value="Save" class="btn btn-warning">
            </form>
        </td>
        <td>
            {{ $b->entry()->count() }}
        </td>       
        <td>
            <a href="{{route('scan.export' , [$b , 'csv'])}}" title="unde?">Upload</a>
        </td>
        <td>
            <a href="{{route('scan.export' , [$b , 'pdf'])}}" title="csv">Raport</a>
        </td>
    </tr>
    @endforeach
</table>


@push('scripts') 
<script type="text/javascript">    
    function edit_cutie( b )
    {        
        $("#B"+b+" span").hide();           
        $("#B"+b+" form").show();        
    }   
</script>
@endpush