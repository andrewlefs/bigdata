register '/user/yarn/GAME/LIBGAME/pigjavamainv2.jar';
%declare ALIAS 'bog'

STOCK_C = LOAD '$ALIAS.roles$serverid' using org.apache.hive.hcatalog.pig.HCatLoader();
STOCK_D = LOAD '$ALIAS.account$serverid' using org.apache.hive.hcatalog.pig.HCatLoader();
STOCK_G = LOAD 'graph_mobo_vn.account_service_$gameid' using org.apache.hive.hcatalog.pig.HCatLoader(); 
--START PROCCESS

--PROCESS role

STOCK_C1 = FILTER STOCK_C BY roleid IS NOT NULL AND createdate IS NOT NULL;
STOCK_C2 = FOREACH STOCK_C1 GENERATE  accid,myudfs.ToJson(myudfs.TestHex(accountname)) as id,roleid,rolelevel,myudfs.ToJson(myudfs.TestHex(rolename)) as rolename,createdate,( (lastplayingdate IS NOT NULL) ? lastplayingdate : createdate) as LastLogin:chararray, ToString(CurrentTime(),'yyyy-MM-dd HH:mm:ss') as date:chararray ; 

STOCK_G1 = FOREACH STOCK_G GENERATE mobo_id,(chararray)$2 AS mobo_service_id,fullname ; 

STOCK_C_G = JOIN STOCK_C2 BY id, STOCK_G1 BY mobo_service_id;

--INFOMATION NEED

STOCK_FINAL = FOREACH STOCK_C_G GENERATE (chararray)$7 as date,(chararray)$7 as date_modify,$gameid as game_id,$serverid as server_id,(chararray)$1 as accid,(chararray)$1 as msi,$8 as mobo_id,(chararray)$10 as fullname,(chararray)$2 as role_id,(chararray)$4 as role_name,(chararray)$5 as create_role_date,(chararray)$6 as last_login_date,(int)$3 as level;

STORE STOCK_FINAL INTO 'bigdata.role' USING org.apache.hive.hcatalog.pig.HCatStorer();

