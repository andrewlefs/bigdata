register '/user/yarn/GAME/LIBGAME/pigjavamainv2.jar';
%declare ALIAS 'ctt';

STOCK_D = LOAD '$ALIAS.t_zhanghao' using org.apache.hive.hcatalog.pig.HCatLoader();
STOCK_G = LOAD 'graph_mobo_vn.account_service_$gameid' using org.apache.hive.hcatalog.pig.HCatLoader(); 
--START PROCCESS

--PROCESS t_zhanghao

STOCK_D1 = GROUP STOCK_D BY (third_uname,guid); 

STOCK_D2 = FOREACH STOCK_D1 GENERATE group.third_uname as third_uname,group.guid as guid,ToString(CurrentTime(),'yyyy-MM-dd HH:mm:ss') as date:chararray; 

--STOCK_D1 = FOREACH STOCK_D GENERATE third_uname,guid,ToString(CurrentTime(),'yyyy-MM-dd HH:mm:ss') as date:chararray; 

STOCK_G1 = GROUP STOCK_G BY (mobo_id,mobo_service_id,fullname); 
STOCK_G2 = FOREACH STOCK_G1 GENERATE group.mobo_id as mobo_id,(chararray)group.mobo_service_id,group.fullname as fullname ; 
--STOCK_G1 = FOREACH STOCK_G GENERATE mobo_id,(chararray)$2 AS mobo_service_id,fullname ;
 
STOCK_D_G = JOIN STOCK_D2 BY third_uname, STOCK_G2 BY $1 ;
--INFOMATION NEED

STOCK_FINAL = FOREACH STOCK_D_G GENERATE $2 as date,$gameid as game_id,$0 as accid,$0 as msi,$3 as mobo_id,(chararray)$5 as fullname;
STORE STOCK_FINAL INTO 'bigdata.account' USING org.apache.hive.hcatalog.pig.HCatStorer();
