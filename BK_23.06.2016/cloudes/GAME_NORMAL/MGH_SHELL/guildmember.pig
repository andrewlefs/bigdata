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
STOCK_B1 = FILTER STOCK_B BY allianceid IS NOT NULL And allianceid != 0;
STOCK_B2 = FOREACH STOCK_B1 GENERATE uid,allianceid,myudfs.TimestamptoDate(jointime) as joinTime; 
--PROCESS playerinfo
STOCK_C1 = FOREACH STOCK_C GENERATE uid,level,customname,myudfs.TimestamptoDate(createtime) as createTime; 
--PROCESS uidmapper2
STOCK_D1 = FOREACH STOCK_D GENERATE (chararray)id as id,zone,uid; 

--JOIN allianceinfo & useralliance
STOCK_A_B = JOIN STOCK_A1 BY id, STOCK_B2 BY allianceid;

--JOIN STOCK_A_B & playerinfo
STOCK_A_B_C = JOIN STOCK_A_B BY uid, STOCK_C1 BY uid;

--JOIN STOCK_A_B_C & uidmapper2
STOCK_A_B_C_D = JOIN STOCK_A_B_C BY $4, STOCK_D1 BY uid;

STOCK_G1 = FOREACH STOCK_G GENERATE mobo_id,(chararray)$2 AS mobo_service_id,fullname ; 
STOCK_A_B_C_D_G = JOIN STOCK_A_B_C_D BY $11, STOCK_G1 BY mobo_service_id;



--INFOMATION NEED
STOCK_FINAL = FOREACH STOCK_A_B_C_D_G GENERATE CONCAT('$ALIAS',CONCAT('_',CONCAT((chararray)$serverid,CONCAT('_',(chararray)$0)))) as game_guild_id,$3 as date,$6 as join_date,$11 as msi_mem,$11 as accid_mem,$14 as mobo_id,(chararray)$16 as fullname,(chararray)$4 as role_id_mem,0 as statussend;
STORE STOCK_FINAL INTO 'bigdata.guild_member' USING org.apache.hive.hcatalog.pig.HCatStorer();