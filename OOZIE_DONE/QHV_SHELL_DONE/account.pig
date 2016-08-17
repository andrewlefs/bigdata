register '/home/java/filejar/pigjavamainv2.jar';

%declare ALIAS 'qhv';
STOCK_A = LOAD '$ALIAS.player$serverid' using org.apache.hive.hcatalog.pig.HCatLoader() ;
STOCK_G = LOAD 'graph_mobo_vn.account_service_$gameid' using org.apache.hive.hcatalog.pig.HCatLoader(); 

--START PROCCESS

STOCK_A0 = FILTER STOCK_A BY $2 IS NOT NULL;
STOCK_A1 = GROUP STOCK_A0 BY ($0,$2);

STOCK_A2 = FOREACH STOCK_A1 GENERATE group.$0 as id,FLATTEN(STRSPLIT(group.$1, '_')) as (a1:chararray, msi:chararray),
ToString(CurrentTime(),'yyyy-MM-dd HH:mm:ss') as date:chararray ;

--PROCESS account

STOCK_G0 = GROUP STOCK_G BY (mobo_id,mobo_service_id,fullname);
STOCK_G1_1 = FILTER STOCK_G0 BY group.$0 IS NOT NULL And group.$1 IS NOT NULL;
STOCK_G2 = FOREACH STOCK_G1_1 GENERATE group.$0 as mobo_id,(chararray)group.$1 AS mobo_service_id,group.$2 as fullname;


STOCK_A_G = JOIN STOCK_A2 BY $2, STOCK_G2 BY $1;
--INFOMATION NEED
STOCK_GROUP = GROUP STOCK_A_G BY ($2,$3,$4,$5,$6);
STOCK_FINAL = FOREACH STOCK_GROUP GENERATE group.$1 as date,$gameid as game_id,group.$3 as accid,group.$3 as msi,group.$2 as mobo_id,(chararray)group.$4 as fullname;

--STORE STOCK_FINAL INTO 'output/BOG/account$serverid';
--STORE STOCK_FINAL INTO 'bigdata.account' USING org.apache.hive.hcatalog.pig.HCatStorer();
