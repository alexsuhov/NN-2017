@inject('batch', 'App\modules\DataEntry\Batch')
@inject('arhiva', 'App\modules\DataEntry\EntryArhiva')


<table class="table" >
    <caption>
        Aveti X documente scanate de mai multe ori <br />
        Aveti Y documente deja scanate
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
        </td>
        <td  align="center">
            <input type="checkbox" class="check_one">
        </td>
        <td>
            <a href="#" title="unde?">Move it</a>
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
            <th width="50 px">
                <input type="checkbox" class="form-control check_all" >
            </th>
            <th>
                <div class="btn-group">
                    <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Action <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="#arhiva">csv Trimite</a></li>
                        <li><a href="#">csv Raport</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Arhivare</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">csv Arh.V</a></li>
                    </ul>
                </div>
            </th>
        </tr>
    </thead>
    @foreach ( $arhiva->paginate(10)  as $cutie )
    <tr>        
        <td>
            {{ $cutie->batch_name }}
        </td>
        <td>
            <span class="badge">T</span>
            {{ $cutie->cutie_SKP }}</span>
        </td>
        <td align="center">
            <input type="checkbox" class="check_one">
        </td>
        <td>
            <a href="#">edit Cutie</a>
        </td>
        <td>
            <a href="#" title="unde?">csv Trimite</a>
        </td>
        <td>
            <a href="#" title="csv">csv Raport</a>
        </td>
        <td>
            Arhivare
        </td>
        <td>
            <a href="#" title="csv">csv Arh.V</a>
        </td>
    </tr>
    @endforeach
</table>