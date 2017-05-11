@inject('batch', 'App\modules\DataEntry\Batch')
@inject('arhiva', 'App\modules\DataEntry\EntryArhiva')

<a href="<?=url('sync')?>">Sync</a>



<table class="table" >
    <caption>        
        Aveti {{ $batch->groupBy('id_entry')
                ->havingRaw('count(id_entry) > 1')        
                ->addSelect('id_entry')
            //    ->addSelect(DB::raw('count(id_entry) as total'))
                ->get()->count() }} documente scanate de mai multe ori <br />
                
        Aveti {{ $batch->has('entry.arhiva')->count() }} documente deja scanate
    </caption>
    <thead>
        <tr>
            <th>Batch LIVE</th>
            <th>Cutie</th>
            <th width="50 px">
                <input type="checkbox" class="form-control check_all" >
            </th>
            <th>
                <button type="button" class="btn btn-warning ">Move</button>
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
            {{ $batch->where('batch' ,$cutie->batch )->has('entry.arhiva')->count()  }}
            {{ $batch
                ->where('batch' ,$cutie->batch )        
                ->whereIn('id_entry',function ($query) {
                        $query
                        ->from('batch')
                        ->groupBy('id_entry')
                        ->havingRaw('count(id_entry) > 1')        
                        ->addSelect('id_entry');
                    })->count()
            }} 
        </td>
        <td  align="center">
            <input type="checkbox" class="check_one">
        </td>
        <td>
            <a href="{{route('scan.show' , $cutie->batch )}}" title="unde?">Move it</a>
            <br />fara Data Entry:
            {{ $batch->where('batch' ,$cutie->batch )->doesntHave('entry')->first()->id_entry }}
        </td>        
    </tr>
    @endforeach
</table>

<a name="arhiva"></a> 
<table class="table">
    <thead>
        <tr>
            <th>Batch</th>
            <th>Cutie</th>   
            <th>Doc Count</th>
            <th width="50 px">
                <input type="checkbox" class="form-control check_all" >
            </th>
            <th>
                <div class="btn-group">
                    <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Action <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('scan.edit' , [1])}}">csv Trimite</a></li>
                        <li><a href="{{url('scan/raport')}}">csv Raport</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Arhivare</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">csv Arh.V</a></li>
                    </ul>
                </div>
            </th>
            <th></th>
        </tr>
    </thead>
    @foreach ( $arhiva->withCount('entry')->has('entry')->orderBy('id_batch','desc')->paginate(10)  as $b )
    <tr>        
        <td>           
            <a href="{{url('list/search')."?batch=$b->id_batch"}}" >{{ $b->batch_name }}</a>
        </td>
        <td onclick="javascript:edit_cutie({{$b->id_batch}})" id="B{{$b->id_batch}}">
            <span class="badge" >T</span>
            <span>{{ $b->cutie_SKP }}</span>
            <form action="{{route('scan.update',[$b])}}" style="display: none" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input value="<?=$b->cutie_SKP?>" name="cutie_SKP" >
                <input type="submit" value="Save" class="btn btn-warning">
            </form>
        </td>
        <td>
            {{$b->entry_count}}
        </td>
        <td align="center">
            <input type="checkbox">
        </td>        
        <td>
            <a href="{{route('scan.edit' , [$b , 'csv'])}}" title="unde?">CSV</a>
        </td>
        <td>
            <a href="{{route('scan.edit' , [$b , 'pdf'])}}" title="csv">PDF</a>
        </td>
    </tr>
    @endforeach
</table>


<script type="text/javascript">
    
    function edit_cutie( b )
    {
        
        $("#B"+b+" span").hide();           
        $("#B"+b+" form").show();
        
    }

</script>