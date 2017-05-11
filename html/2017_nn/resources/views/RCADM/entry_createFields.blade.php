<div class="btn btn-default btn-group btn-group-justified" role="group" aria-label="...">
    <?php
    foreach ($field::ofType('tab')->get() as $tab ){ ?>
    <div class="btn-group" role="group">
        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{ $tab->descriere }}
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
        <?php foreach ($tab->fields as $ope) { ?>
            <li><a class="produs" href="?produs={{ $ope->id_field }}">{{ $ope->descriere }}</a></li>
        <?php } ?>
        </ul>
    </div>
    <?php } ?>
    <!-- toate Produsele -->
    <div class="btn-group" role="group">
        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="TRUE">
            Toate
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
        <?php foreach ($field::ofType('produs')->get() as $ope) { ?>
            <li><a class="produs"  href="?produs={{ $ope->id_field }}">{{ $ope->descriere }}</a></li>
        <?php } ?>
        </ul>
    </div>
    <!-- [END] toate Produsele -->
</div>

<table width="100%">
    <?php        
    $ope = $field::ofType('operatiune')->find( empty($_GET['operatiune'])?old('operatiune'):$_GET['operatiune'] );
    if(empty($ope))return;
   
    echo $ope->descriere;   
    echo Form::hidden('operatiune', $ope->id_field) ;
    
    foreach ($ope->fields as $i=>$doc ){
        echo ($i%3) ? "" : "<tr id='". $i%3 ."'>" ?>  
            <td style="width: 20%">                
            {{ Form::checkbox( "doc[$doc->id_field]" , $doc->id_field , old("doc[$doc->id_field]" ) , ['id'=>'D'.$doc->id_field]) }}                                                        
            {{ Form::label( "D".$doc->id_field , " " .$doc->descriere ) }}
            </td>
        <?= (1+$i%3) ? "" : "</tr>";     
    } ?> 
</table>