register '/user/yarn/GAME/LIBGAME/pigjavamainv2.jar';
%declare ALIAS 'tieuhiep';

STOCK_D = LOAD '$ALIAS.role_name_map$serverid' using org.apache.hive.hcatalog.pig.HCatLoader() AS (idrole_name_map,role_id,role_name,plat_user_name,ditch_name); 
STOCK_G = LOAD 'graph_mobo_vn.account_service_$gameid' using org.apache.hive.hcatalog.pig.HCatLoader(); 

--PROCESS role_name_map
STOCK_D2 = FOREACH STOCK_D GENERATE $0 as idrole_name_map,$1 as role_id,myudfs.TestHex($2) as role_name,FLATTEN(STRSPLIT(myudfs.TestHex($3), '_')) as (a1:chararray, plat_user_name:chararray), ToString(CurrentTime(),'yyyy-MM-dd HH:mm:ss') as date:chararray; 
--INFOMATION NEED

STOCK_G1 = GROUP STOCK_G BY (mobo_id,mobo_service_id,fullname);

STOCK_G2 = FOREACH STOCK_G1 GENERATE group.mobo_id as mobo_id,(chararray)group.mobo_service_id AS mobo_service_id,group.fullname as fullname ;

STOCK_D_G = JOIN STOCK_D2 BY $4, STOCK_G2 BY mobo_service_id;

STOCK_FINAL = FOREACH STOCK_D_G GENERATE $5 as date,'$gameid' as game_id,$4 as accid,$4 as msi,$6 as mobo_id,(chararray)$8 as fullname;
STORE STOCK_FINAL INTO 'bigdata.account' USING org.apache.hive.hcatalog.pig.HCatStorer();
