register '/user/yarn/GAME/LIBGAME/pigjavamainv2.jar';
%declare ALIAS 'mgh'

STOCK_A = LOAD '$ALIAS.allianceinfo$serverid' using org.apache.hive.hcatalog.pig.HCatLoader() ;
STOCK_B = LOAD '$ALIAS.useralliance$serverid' using org.apache.hive.hcatalog.pig.HCatLoader() ;
STOCK_C = LOAD '$ALIAS.playerinfo$serverid' using org.apache.hive.hcatalog.pig.HCatLoader() ; 
STOCK_D = LOAD '$ALIAS.uidmapper2' using org.apache.hive.hcatalog.pig.HCatLoader() ;

STOCK_G = LOAD 'graph_mobo_vn.account_service_$gameid' using org.apache.hive.hcatalog.pig.HCatLoader(); 

--START PROCCESS

--PROCESS allianceinfo
STOCK_A1 = FOREACH STOCK_A GENERATE id,name,createrid,ToString(CurrentTime(),'yyyy-MM-dd HH:mm:ss') as date:chararray ; 
--PROCESS useralliance
STOCK_B1 = FOREACH STOCK_B GENERATE uid,myudfs.TimestamptoDate(jointime) as joinTime; 
--PROCESS playerinfo
STOCK_C1 = FOREACH STOCK_C GENERATE uid,level,customname; 
--PROCESS uidmapper2
STOCK_D1 = FOREACH STOCK_D GENERATE (chararray)id as id,zone,uid; 

--JOIN allianceinfo & useralliance
STOCK_A_B = JOIN STOCK_A1 BY createrid, STOCK_B1 BY uid;

--JOIN STOCK_A_B & playerinfo
STOCK_A_B_C = JOIN STOCK_A_B BY createrid, STOCK_C1 BY uid;

--JOIN STOCK_A_B_C & uidmapper2
STOCK_A_B_C_D = JOIN STOCK_A_B_C BY createrid, STOCK_D1 BY uid;

STOCK_G1 = FOREACH STOCK_G GENERATE mobo_id,(chararray)$2 AS mobo_service_id,fullname; 
STOCK_A_B_C_D_G = JOIN STOCK_A_B_C_D BY $9, STOCK_G1 BY mobo_service_id;

--INFOMATION NEED
STOCK_FINAL = FOREACH STOCK_A_B_C_D_G GENERATE $3 as date,$3 as date_modify,$gameid as game_id,$serverid as server_id,CONCAT('$ALIAS',CONCAT('_',CONCAT((chararray)$serverid,CONCAT('_',(chararray)$0)))) as game_guild_id,
CONCAT('$ALIAS',CONCAT('_',CONCAT((chararray)$serverid,CONCAT('_',(chararray)$1)))) as game_guild_name,
$5 as game_guild_create_date,(chararray)$8 as game_guild_leader_name,$9 as msi_leader,$12 as mobo_id,(chararray)$14 as fullname,$9 as accid_leader ,(chararray)$2 as role_id_leader;
STORE STOCK_FINAL INTO 'bigdata.guild' USING org.apache.hive.hcatalog.pig.HCatStorer();
