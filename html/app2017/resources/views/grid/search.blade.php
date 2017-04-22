@inject('model', '\App\modules\DataEntry\Entry')

<?php 

if(isset($_GET['id_aplicatie']) && isset($_GET['search']))
    $model = $model->where("id_aplicatie", $_GET['search'] ) ;
elseif(isset($_GET['search']))
    $model = $model->where("cif", $_GET['search'] ) ; 

if(isset($_GET['pachet']))
    $model = $model->where("pachet_id", $_GET['pachet'] ) ;

if(isset($_GET['batch']))
    $model = $model->where("batch_id", $_GET['batch'] ) ;
    
$rows = $model->get();

if(empty($rows)) 
{   echo "Nici o inregistrare nu corespunde criteriilor!" ;
    return;
}
?>



<table class="table table-striped table-condensed">
    <tr>        
        <th>
            CIF | Document
        </th>
        <th>
            Produs
        </th>
        <th>
            Id Aplicatie
        </th>
        <th>
            USER
        </th>
        <th>
            Pachet Created at:
        </th>
        <th>
            Cutie / Batch
        </th>
    </tr>
@foreach ($rows as $row )
    <tr>
        <td>
            {{ $row->cif or '#n/a' }} |
            {{ $row->document->descriere or '#n/a' }}
        </td>
        <td>
            {{ $row->produs->descriere or '#n/a' }}
        </td>
        <td>
            {{ $row->id_aplicatie or '#n/a' }}
        </td>
        <td>
            {{ $row->pachet->user->name or "#n/a" }}
        </td>
        <td>
            {{ $row->pachet->created_at or "#n/a" }}
        </td>
        <td>
            {{ ($row->arhiva)?$row->arhiva->skp_serie.$row->arhiva->skp_id : "#n/a" }} /
            {{ $row->arhiva->batch_name or "#n/a" }}
        </td>                
    </tr>
@endforeach
</table>