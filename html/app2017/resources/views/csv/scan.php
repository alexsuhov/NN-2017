<?php

$out = fopen('php://output', 'w');
$toFile="Nume batch: ".$rows->batch_name.", Numar documente: " . $rows->entry->count() . "\n";
fwrite($out, $toFile);

$time = strtotime( $rows->created_at );
$datascan = date('m/d/Y',$time);

foreach($rows->entry as $entry)
{              
        if (!empty($entry->data_semnare) && $entry->data_semnare != '0000-00-00')
                $data_aplicatie = $entry->data_semnare . ' 00:00:00';        
        elseif ( isset($_GET['arhiva_veche']) )
                $data_aplicatie = '2003-01-01 10:49:13';
        else    $data_aplicatie = $entry->data_aplicatie ;
    
        $p = explode('\\', $entry->PATH);
        $entry->link =  $p[ sizeof($p) - 1] ;
        
    $toFile = $entry->cif . "," . 
            $entry->produs->cod . "," .
            $entry->document->cod . "," .             
            $datascan. "," .             
            $entry->arhiva->skp_serie . $entry->arhiva->skp_id . "," .
            $entry->id_aplicatie . "," . 
            $entry->produs->descriere ."," . 
            $entry->document->descriere .
            "\n";
        
    fwrite($out, $toFile);
}
fclose($out);

$fisier = 'raport_bacth_' . $rows->batch_name . '_' . date('YmdHis') . '.csv';

header("Content-Disposition: attachment; filename='$fisier'");
header("Cache-control: private");
header("Content-type: application/force-download");
header("Content-transfer-encoding: binary\n");
