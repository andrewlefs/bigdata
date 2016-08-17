register '/usr/hdp/2.3.4.0-3485/pig/lib/mysql-connector-java-5.1.34.jar';
register '/usr/hdp/2.3.4.0-3485/pig/lib/piggybank.jar';
register '/home/java/filejar/json-simple-1.1.jar';
register '/home/java/filejar/pigjava.jar';

STOCK_C = LOAD 'tieuhiep.role_brief$serverid' using org.apache.hive.hcatalog.pig.HCatLoader(); 
STOCK_D = LOAD 'tieuhiep.role_name_map$serverid' using org.apache.hive.hcatalog.pig.HCatLoader() AS (idrole_name_map,role_id,role_name,plat_user_name,ditch_name); 

--PROCESS role_brief 
STOCK_C1 = FOREACH STOCK_C GENERATE ToString(CurrentTime(),'yyyy-MM-dd HH:mm:ss') as date:chararray,$1 as role_id,myudfs.TestHex($2) as role_name,myudfs.TimestamptoDate($13) as create_role_date, myudfs.TimestamptoDate($15) as last_login_date,$10; 
--DUMP STOCK_B2;

--PROCESS role_name_map
STOCK_D1 = FOREACH STOCK_D GENERATE $0 as idrole_name_map,$1 as role_id,myudfs.TestHex($2) as role_name,FLATTEN(STRSPLIT(myudfs.TestHex($3), '_')) as (a1:chararray, plat_user_name:chararray); 
--DUMP STOCK_D2;

--JOIN army_brief & role_name_map
STOCK_C_D = JOIN STOCK_C1 BY role_id LEFT OUTER, STOCK_D1 BY role_id;
--DUMP STOCK_B_D;

--INFOMATION NEED
STOCK_FINAL = FOREACH STOCK_C_D GENERATE $0 as date,$0 as date_modify,$gameid as game_id,$serverid as server_id,$10 as accid,$10 as msi,$1,$2,$3,$4,$5 as level;
STORE STOCK_FINAL INTO 'role_history' USING org.apache.pig.piggybank.storage.DBStorage('com.mysql.jdbc.Driver','jdbc:mysql://10.10.20.13/datawarehouse','mapreduce','0XfAWJwiwb','INSERT INTO role_history(`date` ,`date_modify` ,`game_id`,`server_id`,`accid`,`msi`,`role_id`,`role_name`,`create_role_date`,`last_login_date`,`level`) VALUES(?,?,?,?,?,?,?,?,?,?,?) ');
--STORE STOCK_FINAL INTO 'role' USING org.apache.pig.piggybank.storage.DBStorage('com.mysql.jdbc.Driver','jdbc:mysql://10.10.20.13/datawarehouse','mapreduce','0XfAWJwiwb','INSERT INTO role(`date` ,`date_modify` ,`game_id`,`server_id`,`accid`,`msi`,`role_id`,`role_name`,`create_role_date`,`last_login_date`,`level`) VALUES(?,?,?,?,?,?,?,?,?,?,?) ON DUPLICATE KEY UPDATE `date_modify` = ?,`level`=?');


