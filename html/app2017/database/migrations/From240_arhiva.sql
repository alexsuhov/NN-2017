DELETE FROM rcadm.entries_arhiva;
ALTER TABLE rcadm.entries_arhiva AUTO_INCREMENT = 1;

insert into rcadm.entries_arhiva (batch_name , skp_old )
    SELECT `batch` , `skp`
        FROM bubu.date_xls 
        WHERE 1 and `batch` is NOT null 
        GROUP BY `batch` , `skp`
        ORDER BY `id_xls`;

UPDATE rcadm.`entries_arhiva` SET `skp_id` = SUBSTRING(`skp_old`, 2, 10)         
WHERE LENGTH (`skp_old`) = 10 and `skp_old` regexp '^T[0-9]' ;

DELETE FROM  rcadm.batch3;
ALTER TABLE  rcadm.batch3 AUTO_INCREMENT = 1;
DELETE FROM  rcadm.batch3_poze;
ALTER TABLE  rcadm.batch3_poze AUTO_INCREMENT = 1;

insert into rcadm.batch3 (ID_DOC,id_entry,batch,cutie,`data`,produs,doc,cif)
select ID_DOC,id_entry,batch,cutie,`data`,produs,doc,cif from bubu.batch ;

insert into rcadm.batch3_poze (ID_DOC,`PATH`)
select ID_DOC,`PATH` from bubu.batch_poze ;

DELETE FROM  rcadm.batch1;
ALTER TABLE  rcadm.batch1 AUTO_INCREMENT = 1;
DELETE FROM  rcadm.batch1_poze;
ALTER TABLE  rcadm.batch1_poze AUTO_INCREMENT = 1;

insert into rcadm.batch1 (ID_DOC,id_entry,batch,cutie,`data`,id_csv)
select ID_DOC,id_entry,batch,cutie,`data`,id_csv from bubu.`b_flux 3_batch` ;

insert into rcadm.batch1_poze (ID_DOC,`PATH`)
select ID_DOC,`PATH` from bubu.b_flux3_batch_poze ;