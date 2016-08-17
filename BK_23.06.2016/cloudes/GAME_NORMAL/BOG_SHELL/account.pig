register '/user/yarn/GAME/LIBGAME/pigjavamainv2.jar';
%declare ALIAS 'bog'

STOCK_D = LOAD '$ALIAS.account$serverid' using org.apache.hive.hcatalog.pig.HCatLoader();
STOCK_G = LOAD 'graph_mobo_vn.account_service_$gameid' using org.apache.hive.hcatalog.pig.HCatLoader(); 
--START PROCCESS
STOCK_D0 = FOREACH STOCK_D GENERATE accid,myudfs.ToJson(myudfs.TestHex(accname)) as id,gameid; 
STOCK_G1 = GROUP STOCK_G BY (mobo_id,mobo_service_id,fullname);

STOCK_G2 = FOREACH STOCK_G1 GENERATE group.mobo_id,(chararray)group.mobo_service_id AS mobo_service_id,group.fullname as fullname ;

STOCK_D1 = GROUP STOCK_D0 BY (id);
STOCK_D2 = FOREACH STOCK_D1 GENERATE $0 as id,ToString(CurrentTime(),'yyyy-MM-dd HH:mm:ss') as date:chararray ;

STOCK_D_G = JOIN STOCK_D2 BY $0, STOCK_G2 BY $1 ;

--INFOMATION NEED
STOCK_FINAL = FOREACH STOCK_D_G GENERATE $1 as date,$gameid as game_id,$0 as accid,$0 as msi,$2 as mobo_id,(chararray)$4 as fullname;

--STORE STOCK_FINAL INTO 'output/BOG/account$serverid';
STORE STOCK_FINAL INTO 'bigdata.account' USING org.apache.hive.hcatalog.pig.HCatStorer();

