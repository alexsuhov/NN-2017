<SCRIPT LANGUAGE="JavaScript">

function UpdateBarcode(PDF417Ctrl)
{
	//PDF417Ctrl.DataToEncode=BarCodeForm.DataToEncode.value;
	PDF417Ctrl.CompactionMode=0;
	PDF417Ctrl.ErrorCorrectionLevel=9;
	PDF417Ctrl.DataColumns=3;
	PDF417Ctrl.DataRows=0;
	//PDF417Ctrl.CompactPDF==BarCodeForm.CompactPDF.checked;
	PDF417Ctrl.Y2XRatio='2';
	PDF417Ctrl.Orientation=0;
	//PDF417Ctrl.Transparent=BarCodeForm.Transparent.checked;
	PDF417Ctrl.BackColor=16777215;
	PDF417Ctrl.ForeColor=0;
	PDF417Ctrl.QuietZone='ON';
	PDF417Ctrl.AlignH=1;
	PDF417Ctrl.AlignV=1;
}

</SCRIPT>


<table style="height:70px" width="220px">
    <tr valign="top">
        <td width="52px"></td>
        <td height="40px" style="font-family:Tahoma;font-size:12">				
            <OBJECT ID="PDF417Ctrl<?php ?>" WIDTH="125px" HEIGHT="40px" CLASSID="CLSID:B26FE0A3-C7AD-4DD3-B9E7-BC6524112444">							 
                <PARAM NAME="DataToEncode" VALUE="<? echo convert(10,$id_pachet) ?>">						
            </OBJECT>								
        </td>
    </tr>						
    <tr>		
        <td width="52px"></td>						
        <td style="font-family:Tahoma;font-size:12">
            <?=$rows->count() ?> <br />					            
            <?='Contine:'. $rows->count().' docs'; ?>						
            <hr width="20">						
        </td>						
    </tr>
    <?php foreach($rows as $row) { ?> 
    <tr valign="top">
        <td width="52px"></td>
        <td>						
            <OBJECT ID="PDF417Ctrl<?=$row->id_entry ?>" WIDTH="125px" HEIGHT="40px" CLASSID="CLSID:B26FE0A3-C7AD-4DD3-B9E7-BC6524112444">							 
                <PARAM NAME="DataToEncode" VALUE="<?=$row->id_entry?>,<?=$row->produs->cod?>,<?=$row->document->cod?>,<?=$row->cif?>">						
            </OBJECT>	
        </td>
    </tr>						
    <tr>		
        <td width="52px"></td>						
        <td style="font-family:Tahoma;font-size:12">									
            <?php echo 'CIF:  ' . $row->cif; ?>						
                <?php if($row->id_aplicatie <> 0) echo ' ' . $row->id_aplicatie; ?>
            <br />	
                <?php 						
                if($row['flag']=='0')	echo $row->document->cod.' ';										
                echo ($row['data_semnare'] != '0000-00-00') ? $row['data_semnare'] : substr($row->document->descriere,0,20); ?>							
            <br />						
                <?php						
                echo $row->produs->cod.' ';						
                echo substr($row->produs->descriere,0,20); ?>						
            <hr width="20">												
        </td>						
    </tr>					
<?php } ?>
    <tr valign="top">
        <td width="52px"></td>
        <td height="40px" style="font-family:Tahoma;font-size:12">				
            <OBJECT ID="PDF417Ctrl<?=$row; ?>" WIDTH="125px" HEIGHT="40px" CLASSID="CLSID:B26FE0A3-C7AD-4DD3-B9E7-BC6524112444">							 
                <PARAM NAME="DataToEncode" VALUE="1<? echo convert(10,$id_pachet) ?>">						
            </OBJECT>									
        </td>
    </tr>						
    <tr>	
        <td width="52px"></td>				
        <td style="font-family:Tahoma;font-size:12">					
            <hr width="20">										
        </td>						
    </tr>
</table>

