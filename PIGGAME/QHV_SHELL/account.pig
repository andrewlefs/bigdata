register '/usr/hdp/2.3.4.0-3485/pig/lib/mysql-connector-java-5.1.34.jar';
register '/usr/hdp/2.3.4.0-3485/pig/lib/piggybank.jar';
register '/home/java/filejar/pigjavamain.jar';
%declare ALIAS 'bog'
STOCK_D = LOAD '$ALIAS.account$serverid' using org.apache.hive.hcatalog.pig.HCatLoader();
STOCK_G = LOAD 'graph_mobo_vn.account_service_$gameid' using org.apache.hive.hcatalog.pig.HCatLoader(); 
--START PROCCESS

--PROCESS account
STOCK_D1 = FOREACH STOCK_D GENERATE accid,myudfs.ToJson(myudfs.TestHex(accname)) as id,gameid,ToString(CurrentTime(),'yyyy-MM-dd HH:mm:ss') as date:chararray; 
STOCK_G1 = FOREACH STOCK_G GENERATE mobo_id,(chararray)$2 AS mobo_service_id,fullname ;
 
STOCK_D_G = JOIN STOCK_D1 BY id, STOCK_G1 BY mobo_service_id ;
--INFOMATION NEED
STOCK_FINAL = FOREACH STOCK_D_G GENERATE $3 as date,$gameid as game_id,$1 as accid,$1 as msi,$4 as mobo_id,(chararray)$6 as fullname;

STORE STOCK_FINAL INTO 'output/BOG/account$serverid';
--STORE STOCK_FINAL INTO 'bigdata.account' USING org.apache.hive.hcatalog.pig.HCatStorer();
