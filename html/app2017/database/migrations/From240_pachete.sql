DELETE FROM rcadm.pachet;
ALTER TABLE rcadm.pachet AUTO_INCREMENT = 1;

-- INSERT pachet from pachete
INSERT INTO rcadm.pachet (`id_pachet`,`has_name`,`user_x`  )
SELECT `id` , `id_pachet` , `user` 
FROM bubu.`pachete` 
group by `id_pachet` , `user` ;

-- INSERT from date_xls
SET @rownr=0;
INSERT INTO rcadm.pachet 
        (`id_pachet`,   `has_name`,             `user_x` )
SELECT @rownr:=@rownr-1, date_xls.`id_pachet` , date_xls.`user` 
    FROM bubu.date_xls 
    left join rcadm.pachet on (`pachet`.`has_name` = `date_xls`.`id_pachet` and `pachet`.`user_x` = `date_xls`.`user` )
    WHERE 1 and `pachet`.`id_pachet` is null 
    GROUP BY date_xls.`user` , date_xls.`id_pachet`
    ORDER BY `id_xls`;

-- FIX created_at
UPDATE rcadm.`pachet` 
SET  created_at = CONCAT (SUBSTRING(`has_name`,1,4),'-',sUBSTRING(`has_name`,5,2),"-",sUBSTRING(`has_name`,7,2)," ",sUBSTRING(`has_name`,9,2),":",sUBSTRING(`has_name`,11,2),":",sUBSTRING(`has_name`,13,2) )  
               where `has_name` regexp '^[0-9]' ;

 -- USERS !!!
DELETE FROM rcadm.auth_users where id_user !=0;
ALTER TABLE rcadm.auth_users AUTO_INCREMENT = 1;

INSERT INTO rcadm.auth_users (`id_user`,`name`)
SELECT `id_user`,nume from bubu.users;
INSERT INTO rcadm.auth_users (`id_user`,`name`)
SELECT `user_x`, user_x from rcadm.pachet where `user_x` regexp '^[0-9]' AND `user_x` NOT IN (select id_user from rcadm.auth_users) GROUP BY user;

-- FIX User_id
UPDATE rcadm.`pachet` SET  user_id =   user_x
where `user_x` regexp '^[0-9]' ;