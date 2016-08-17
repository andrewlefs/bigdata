register '/usr/hdp/2.3.4.0-3485/pig/lib/mysql-connector-java.jar';
register '/usr/hdp/2.3.4.0-3485/pig/lib/piggybank.jar';
register '/home/java/filejar/pigjavamainv2.jar';
%declare ALIAS 'tieuhiep';

STOCK_D = LOAD '$ALIAS.role_name_map$serverid' using org.apache.hive.hcatalog.pig.HCatLoader() AS (idrole_name_map,role_id,role_name,plat_user_name,ditch_name); 
STOCK_G = LOAD 'account_service_130' USING org.apache.pig.piggybank.storage.DBStorage('com.mysql.jdbc.Driver','jdbc:mysql://10.10.20.138/graph_mobo_vn','coor','coorkabn#$l','SELECT * FROM account_service_130');

DUMP STOCK_G;
/*
--PROCESS role_name_map
STOCK_D2 = FOREACH STOCK_D GENERATE $0 as idrole_name_map,$1 as role_id,myudfs.TestHex($2) as role_name,FLATTEN(STRSPLIT(myudfs.TestHex($3), '_')) as (a1:chararray, plat_user_name:chararray), ToString(CurrentTime(),'yyyy-MM-dd HH:mm:ss') as date:chararray; 
--INFOMATION NEED

STOCK_G1 = FOREACH STOCK_G GENERATE mobo_id,(chararray)$2 AS mobo_service_id,fullname ; 
STOCK_D_G = JOIN STOCK_D2 BY $4, STOCK_G1 BY mobo_service_id;

STOCK_FINAL = FOREACH STOCK_D_G GENERATE $5 as date,$gameid as game_id,$4 as accid,$4 as msi,$6 as mobo_id,(chararray)$8 as fullname;
STORE STOCK_FINAL INTO 'bigdata.account' USING org.apache.hive.hcatalog.pig.HCatStorer();
*/