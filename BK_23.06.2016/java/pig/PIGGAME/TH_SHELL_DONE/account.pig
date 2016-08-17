register '/home/java/filejar/pigjavamainv2.jar';
%declare ALIAS 'tieuhiep';
STOCK_D = LOAD '$ALIAS.role_name_map$serverid' using org.apache.hive.hcatalog.pig.HCatLoader() AS (idrole_name_map,role_id,role_name,plat_user_name,ditch_name); 
STOCK_G = LOAD 'graph_mobo_vn.account_service_$gameid' using org.apache.hive.hcatalog.pig.HCatLoader(); 
--PROCESS role_name_map
STOCK_D1 = FOREACH STOCK_D GENERATE FLATTEN(STRSPLIT(myudfs.TestHex($3), '_')) as (a1:chararray, plat_user_name:chararray), ToString(CurrentTime(),'yyyy-MM-dd HH:mm:ss') as date:chararray; 
STOCK_D2 = GROUP STOCK_D1 BY ($1,$2);
--INFOMATION NEED

STOCK_G0 = GROUP STOCK_G BY (mobo_id,mobo_service_id,fullname);
STOCK_G1_1 = FILTER STOCK_G0 BY group.$0 IS NOT NULL And group.$1 IS NOT NULL;
STOCK_G2 = FOREACH STOCK_G1_1 GENERATE group.$0 as mobo_id,(chararray)group.$1 AS mobo_service_id,group.$2 as fullname;


STOCK_D_G = JOIN STOCK_D2 BY group.$0, STOCK_G2 BY mobo_service_id;

STOCK_FINAL = FOREACH STOCK_D_G GENERATE group.$1 as date,$gameid as game_id,group.$0 as accid,group.$0 as msi,$2 as mobo_id,(chararray)$4 as fullname;
STORE STOCK_FINAL INTO 'bigdata.account' USING org.apache.hive.hcatalog.pig.HCatStorer();
--STORE STOCK_FINAL INTO 'output/TH/account/account_$filename';
--STORE STOCK_FINAL INTO 'account' USING org.apache.pig.piggybank.storage.DBStorage('com.mysql.jdbc.Driver','jdbc:mysql://10.10.20.13/datawarehouse','mapreduce','0XfAWJwiwb','INSERT INTO account(`date`,`game_id` ,`accid`,`msi`) VALUES(?,?,?,?) ON DUPLICATE KEY UPDATE `date` = ?');
