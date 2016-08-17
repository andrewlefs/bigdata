--register '/usr/hdp/2.3.4.0-3485/pig/lib/piggybank.jar';
register '/home/java/filejar/pigjavamainv2.jar';
%declare ALIAS 'bog';
STOCK_D = LOAD '$ALIAS.account$serverid' using org.apache.hive.hcatalog.pig.HCatLoader();
STOCK_G = LOAD 'graph_mobo_vn.account_service_$gameid' using org.apache.hive.hcatalog.pig.HCatLoader(); 
--START PROCCESS

--PROCESS account
STOCK_D0 = FOREACH STOCK_D GENERATE myudfs.ToJson(myudfs.TestHex(accname)) as id; 
STOCK_D1 = GROUP STOCK_D0 BY (id);
STOCK_D2 = FOREACH STOCK_D1 GENERATE $0 as id,ToString(CurrentTime(),'yyyy-MM-dd HH:mm:ss') as date:chararray ;

STOCK_G0 = GROUP STOCK_G BY (mobo_id,mobo_service_id,fullname);
STOCK_G1_1 = FILTER STOCK_G0 BY group.$0 IS NOT NULL And group.$1 IS NOT NULL;
STOCK_G2 = FOREACH STOCK_G1_1 GENERATE group.$0 as mobo_id,(chararray)group.$1 AS mobo_service_id,group.$2 as fullname;


STOCK_D_G = JOIN STOCK_D2 BY $0, STOCK_G2 BY $1 ;

--INFOMATION NEED
STOCK_FINAL = FOREACH STOCK_D_G GENERATE $1 as date,$gameid as game_id,$0 as accid,$0 as msi,$2 as mobo_id,(chararray)$4 as fullname;

--STORE STOCK_FINAL INTO 'output/BOG/account$serverid';
STORE STOCK_FINAL INTO 'bigdata.account' USING org.apache.hive.hcatalog.pig.HCatStorer();

