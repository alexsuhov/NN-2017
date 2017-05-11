SET @rownr = 15000000;
INSERT INTO rcadm.entries       
(id_entry,cif,cod_produs,id_document,id_aplicatie,data_aprobare,data_semnare,
    created_at,branch_v,doc_v,pachet_id,batch_id)

    SELECT 
        `id_xls` as id_entry, 
-- fields
        `cif`,ope.id_field, doc.id_field,
        `id_aplicatie`, `data_aprobare`,`data_semnare`,
        `data_aplicatie`, `branch` as `branch_v`, `doc_v` ,  
-- pachet & arhiva
        pachet.id_pachet as pachet_id,
        entries_arhiva.id_batch as batch_id

        FROM bubu.`date_xls`  
        INNER JOIN rcadm.pachet on ( pachet.has_name = date_xls.id_pachet AND pachet.user_x=date_xls.`user` )
         LEFT JOIN rcadm.entries_arhiva on (entries_arhiva.batch_name=date_xls.batch AND entries_arhiva.skp_old=date_xls.skp) 
        INNER JOIN rcadm.fields as ope on ( cod_operatiune = ope.cod and nume_actiune=ope.descriere and ope.tip ='produs')
        INNER JOIN rcadm.fields as doc on ( id_document = doc.cod and document=doc.descriere and doc.tip='doc')

        where 1
        and id_xls >= @rownr and id_xls < @rownr+3000000 ;
        
