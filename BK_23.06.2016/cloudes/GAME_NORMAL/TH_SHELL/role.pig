register '/user/yarn/GAME/LIBGAME/pigjavamainv2.jar';
%declare ALIAS 'tieuhiep';

STOCK_C = LOAD '$ALIAS.role_brief$serverid' using org.apache.hive.hcatalog.pig.HCatLoader(); 
STOCK_D = LOAD '$ALIAS.role_name_map$serverid' using org.apache.hive.hcatalog.pig.HCatLoader() AS (idrole_name_map,role_id,role_name,plat_user_name,ditch_name); 
STOCK_G = LOAD 'graph_mobo_vn.account_service_$gameid' using org.apache.hive.hcatalog.pig.HCatLoader(); 

--PROCESS role_brief 
STOCK_C1 = FOREACH STOCK_C GENERATE ToString(CurrentTime(),'yyyy-MM-dd HH:mm:ss') as date:chararray,$1 as role_id,myudfs.TestHex($2) as role_name,myudfs.TimestamptoDate($13) as create_role_date, myudfs.TimestamptoDate($15) as last_login_date,$10; 

--PROCESS role_name_map
STOCK_D1 = FOREACH STOCK_D GENERATE $0 as idrole_name_map,$1 as role_id,myudfs.TestHex($2) as role_name,FLATTEN(STRSPLIT(myudfs.TestHex($3), '_')) as (a1:chararray, plat_user_name:chararray); 

STOCK_G1 = FOREACH STOCK_G GENERATE mobo_id,(chararray)$2 AS mobo_service_id,fullname ; 

--JOIN army_brief & role_name_map
STOCK_C_D = JOIN STOCK_C1 BY role_id,STOCK_D1 BY role_id;
--DUMP STOCK_C_D;

STOCK_C_D_G = JOIN STOCK_C_D BY $10,STOCK_G1 BY mobo_service_id;

--INFOMATION NEED
STOCK_FINAL = FOREACH STOCK_C_D_G GENERATE $0 as date,$0 as date_modify,$gameid as game_id,$serverid as server_id,$10 as accid,$10 as msi,$11 as mobo_id,(chararray)$13 as fullname,(chararray)$1 as role_id,(chararray)$2 as role_name,$3 as create_role_date,$4 as last_login_date,$5 as level;
STORE STOCK_FINAL INTO 'bigdata.role' USING org.apache.hive.hcatalog.pig.HCatStorer();
