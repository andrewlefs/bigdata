register '/user/yarn/GAME/LIBGAME/pigjavamainv2.jar';
%declare ALIAS 'mgh'

STOCK_C = LOAD '$ALIAS.playerinfo$serverid' using org.apache.hive.hcatalog.pig.HCatLoader();
STOCK_D = LOAD '$ALIAS.uidmapper2' using org.apache.hive.hcatalog.pig.HCatLoader();
STOCK_G = LOAD 'graph_mobo_vn.account_service_$gameid' using org.apache.hive.hcatalog.pig.HCatLoader(); 
--START PROCCESS

--PROCESS playerinfo
STOCK_C1 = FILTER STOCK_C BY uid IS NOT NULL AND createtime IS NOT NULL;
STOCK_C2 = FOREACH STOCK_C1 GENERATE  uid,level,customname,(chararray)myudfs.TimestamptoDate(createtime) as createdate ,( (lastlogin IS NOT NULL and lastlogin != 0) ? (chararray)myudfs.TimestamptoDate(lastlogin) : (chararray)myudfs.TimestamptoDate(createtime)) as LastLogin, ToString(CurrentTime(),'yyyy-MM-dd HH:mm:ss') as date:chararray ; 

--PROCESS uidmapper2
STOCK_D1 = FOREACH STOCK_D GENERATE (chararray)id as id,zone,uid; 

--JOIN playerinfo & uidmapper2
STOCK_C_D = JOIN STOCK_C2 BY uid, STOCK_D1 BY uid;

STOCK_G1 = FOREACH STOCK_G GENERATE mobo_id,(chararray)$2 AS mobo_service_id,fullname ; 

STOCK_C_D_G = JOIN STOCK_C_D BY id, STOCK_G1 BY mobo_service_id;


--INFOMATION NEED

STOCK_FINAL = FOREACH STOCK_C_D_G GENERATE $5 as date,$5 as date_modify,$gameid as game_id,$serverid as server_id,$6 as accid,$6 as msi,$9 as mobo_id,(chararray)$11 as fullname,(chararray)$0 as role_id,(chararray)$2 as role_name,$3 as create_role_date,$4 as last_login_date,$1 as level;
STORE STOCK_FINAL INTO 'bigdata.role' USING org.apache.hive.hcatalog.pig.HCatStorer();