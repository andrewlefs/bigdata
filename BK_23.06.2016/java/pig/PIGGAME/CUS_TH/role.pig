register '/usr/hdp/2.3.4.0-3485/pig/lib/piggybank.jar';
register '/home/java/filejar/json-simple-1.1.jar';
register '/home/java/filejar/pigjavamain.jar';

STOCK_C = LOAD 'tieuhiep.role_brief$serverid' using org.apache.hive.hcatalog.pig.HCatLoader(); 
STOCK_D = LOAD 'tieuhiep.role_name_map$serverid' using org.apache.hive.hcatalog.pig.HCatLoader() AS (idrole_name_map,role_id,role_name,plat_user_name,ditch_name); 
STOCK_G = LOAD 'graph_mobo_vn.account_service_$gameid' using org.apache.hive.hcatalog.pig.HCatLoader(); 
--PROCESS role_brief 
STOCK_C1 = FOREACH STOCK_C GENERATE ToString(CurrentTime(),'yyyy-MM-dd HH:mm:ss') as date:chararray,$1 as role_id,myudfs.TestHex($2) as role_name,myudfs.TimestamptoDate($13) as create_role_date, myudfs.TimestamptoDate($15) as last_login_date,$10; 
--DUMP STOCK_B2;

--PROCESS role_name_map
STOCK_D1 = FOREACH STOCK_D GENERATE $0 as idrole_name_map,$1 as role_id,myudfs.TestHex($2) as role_name,FLATTEN(STRSPLIT(myudfs.TestHex($3), '_')) as (a1:chararray, plat_user_name:chararray); 
--DUMP STOCK_D2;

STOCK_G0 = GROUP STOCK_G BY (mobo_id,mobo_service_id,fullname);
STOCK_G1_1 = FILTER STOCK_G0 BY group.$0 IS NOT NULL And group.$1 IS NOT NULL;
STOCK_G2 = FOREACH STOCK_G1_1 GENERATE group.$0 as mobo_id,(chararray)group.$1 AS mobo_service_id,group.$2 as fullname;


--JOIN army_brief & role_name_map
STOCK_C_D = JOIN STOCK_C1 BY role_id LEFT OUTER, STOCK_D1 BY role_id;
--DUMP STOCK_B_D;

STOCK_C_D_G = JOIN STOCK_C_D BY $10 LEFT OUTER, STOCK_G2 BY mobo_service_id;

--INFOMATION NEED
STOCK_FINAL = FOREACH STOCK_C_D_G GENERATE $0 as date,$0 as date_modify,$gameid as game_id,$serverid as server_id,$10 as accid,$10 as msi,$11 as mobo_id,(chararray)$13 as fullname,(chararray)$1 as role_id,$2 as role_name,$3 as create_role_date,$4 as last_login_date,$5 as level;
STORE STOCK_FINAL INTO 'bigdata.role' USING org.apache.hive.hcatalog.pig.HCatStorer();
--STORE STOCK_FINAL INTO 'output/TH/role2';
--STORE STOCK_FINAL INTO 'role_history' USING org.apache.pig.piggybank.storage.DBStorage('com.mysql.jdbc.Driver','jdbc:mysql://10.10.20.13/datawarehouse','mapreduce','0XfAWJwiwb','INSERT INTO role_history(`date` ,`date_modify` ,`game_id`,`server_id`,`accid`,`msi`,`role_id`,`role_name`,`create_role_date`,`last_login_date`,`level`) VALUES(?,?,?,?,?,?,?,?,?,?,?) ');
--STORE STOCK_FINAL INTO 'role' USING org.apache.pig.piggybank.storage.DBStorage('com.mysql.jdbc.Driver','jdbc:mysql://10.10.20.13/datawarehouse','mapreduce','0XfAWJwiwb','INSERT INTO role(`date` ,`date_modify` ,`game_id`,`server_id`,`accid`,`msi`,`role_id`,`role_name`,`create_role_date`,`last_login_date`,`level`) VALUES(?,?,?,?,?,?,?,?,?,?,?) ON DUPLICATE KEY UPDATE `date_modify` = ?,`level`=?');


