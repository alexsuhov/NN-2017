CREATE SERVER fedlink
FOREIGN DATA WRAPPER mysql
OPTIONS (USER 'USERNAME', HOST 'Host_IP', DATABASE 'DB_NAME', 
PORT '3306',Password 'PASSWORD');
Once Server Link is created, To create table that uses this connection:

CREATE TABLE test_table (
id     INT(20) NOT NULL AUTO_INCREMENT,
name   VARCHAR(32) NOT NULL DEFAULT '',
other  INT(20) NOT NULL DEFAULT '0',
PRIMARY KEY  (id),
INDEX name (name),
INDEX other_key (other)
)
ENGINE=FEDERATED
DEFAULT CHARSET=latin1
CONNECTION='fedlink/test_table';         
         
mysqldump --user=alex -palex123 --host=192.168.1.100 aplicatie_dis --tables pachete batch batch_poze 'b_flux 3_batch' b_flux3_batch_poze campuri_noi tab_check users date_xls  | mysql --user=root -psanuintri bubu
        
DROP TABLE IF EXISTS  bubu.temp__date_xls;        
CREATE TABLE bubu.temp__date_xls AS 
SELECT  date_xls.* 	
    FROM bubu.date_xls 
LEFT JOIN rcadm.entries on ( entries.id_entry = date_xls.id_xls )       
WHERE entries.id_entry is null
        ; 