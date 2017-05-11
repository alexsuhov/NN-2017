<?php

$out = fopen('php://output', 'w');
foreach($rows->entry as $entry)
{
    if (!empty($entry->data_semnare) && $entry->data_semnare != '0000-00-00')
                $data_aplicatie = $entry->data_semnare . ' 00:00:00';        
        elseif ( isset($_GET['arhiva_veche']) )
                $data_aplicatie = '2003-01-01 10:49:13';
        else    $data_aplicatie = $entry->created_at ;
        
        $p = explode('\\', $entry->PATH);
        $entry->link =  $p[ sizeof($p) - 1] ;
        
    $row = '"'.$entry->cif . '","' . 
            $entry->produs->cod . '","' .
            $entry->document->cod . '","' . 
            $data_aplicatie . '","' . 
            $entry->id_aplicatie . '","' . 
            $entry->arhiva->skp_serie . $entry->arhiva->skp_id . '","' . 
            $aplicatie=0 . '","' . 
            $entry->link . '"' .
            "\n";
        
    fwrite($out, $row);
}
fclose($out);

//$sql_count = mysql_query("select * from counter where id_count=1");
$fisier = 'BATCH_0_0_'. $count . '.csv';
//mysql_query("update counter set counter=counter+1");

header("Content-Disposition: attachment; filename='$fisier'");
header("Cache-control: private");
header("Content-type: application/force-download");
header("Content-transfer-encoding: binary\n");