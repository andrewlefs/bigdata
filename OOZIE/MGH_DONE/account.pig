register 'pigjavamainv2.jar';
%declare ALIAS 'mgh'

STOCK_D = LOAD '$ALIAS.uidmapper2' using org.apache.hive.hcatalog.pig.HCatLoader();
STOCK_G = LOAD 'graph_mobo_vn.account_service_$gameid' using org.apache.hive.hcatalog.pig.HCatLoader(); 
--START PROCCESS

--PROCESS uidmapper2
STOCK_D1 = FOREACH STOCK_D GENERATE id,zone,uid,ToString(CurrentTime(),'yyyy-MM-dd HH:mm:ss') as date:chararray; 

STOCK_G1 = FOREACH STOCK_G GENERATE mobo_id,(chararray)$2 AS mobo_service_id,fullname ;
 
STOCK_D_G = JOIN STOCK_D1 BY id, STOCK_G1 BY mobo_service_id ;

--INFOMATION NEED
STOCK_FINAL = FOREACH STOCK_D_G GENERATE $3 as date,$gameid as game_id,$0 as accid,$0 as msi,$4 as mobo_id,(chararray)$6 as fullname;
STORE STOCK_FINAL INTO 'bigdata.account' USING org.apache.hive.hcatalog.pig.HCatStorer();
