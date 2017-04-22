DROP TABLE IF EXISTS  bubu.temp__doc;
DROP TABLE IF EXISTS  bubu.temp__prod;

-- create TEMPs Fields                
CREATE TABLE bubu.temp__prod AS 
    SELECT `cod_operatiune` as cod_produs,`nume_actiune` as nume        
    FROM bubu.`date_xls` 
    GROUP BY `cod_produs`,`nume` ;

CREATE TABLE bubu.temp__doc AS 
    SELECT `id_document`,`document` as nume
    FROM bubu.`date_xls` 
    GROUP BY `id_document`,`nume` ;

-- empty existing Fields                    
-- TRUNCATE TABLE rcadm.`fields`;
DELETE FROM rcadm.`fields_field`;

DELETE FROM rcadm.`fields`;
ALTER TABLE rcadm.`fields` AUTO_INCREMENT = 1;

-- insert to NEW
INSERT INTO rcadm.fields (id_field,descriere,cod,deleted_at,tip)
    SELECT `id_camp`as id_field ,`descriere`,`cod`,  NULL ,
        if(`tip`=1,'produs', if(`tip`=2,'tab',if(`tip`=3,'doc', NULL)) ) as tip 
    FROM bubu.`campuri_noi` ;

SET @rownr=0;
INSERT INTO rcadm.fields (id_field,descriere,cod,tip,deleted_at)
    SELECT  @rownr:=@rownr-1,nume,id_document, 'doc', '0000-00-00 00:00:01'
    FROM bubu.`temp__doc`  
    left join rcadm.fields on (id_document = cod and nume = descriere and tip = 'doc')
    WHERE 1 and id_field is null  
    ORDER BY `cod`;

INSERT INTO rcadm.fields (id_field,descriere,cod,tip,deleted_at)
    SELECT  @rownr:=@rownr-1,`nume`,`cod_produs`, 'produs', '0000-00-00 00:00:01' 
    FROM bubu.`temp__prod`  
    left join rcadm.fields on (`cod_produs` = cod and `nume` = descriere and tip = 'produs')
    WHERE 1 and id_field is null  
    ORDER BY `cod`;

-- TRUNCATE TABLE rcadm.`fields_field`;
-- produs TO tab
insert into rcadm.fields_field (parent_id , child_id)
select id_tab,id_camp from bubu.tab_check where id_check='0' and id_camp!=10145;
-- 10145 - FK 

-- doc TO Produs
insert into rcadm.fields_field (parent_id , child_id)
select id_camp,id_check from bubu.tab_check where id_tab='0' and (id_camp IN (SELECT fields.id_field FROM rcadm.fields) AND id_check IN (SELECT fields.id_field FROM rcadm.fields)) ;