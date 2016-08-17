register '/user/yarn/GAME/LIBGAME/pigjavamainv2.jar';
%declare ALIAS 'mgh'

STOCK_A = LOAD '$ALIAS.allianceinfo$serverid' using org.apache.hive.hcatalog.pig.HCatLoader() ;
STOCK_B = LOAD '$ALIAS.useralliance$serverid' using org.apache.hive.hcatalog.pig.HCatLoader() ;
STOCK_C = LOAD '$ALIAS.playerinfo$serverid' using org.apache.hive.hcatalog.pig.HCatLoader() ; 
STOCK_D = LOAD '$ALIAS.uidmapper2' using org.apache.hive.hcatalog.pig.HCatLoader() ;

--PROCESS allianceinfo
STOCK_A1 = FOREACH STOCK_A GENERATE id,name,createrid,ToString(CurrentTime(),'yyyy-MM-dd HH:mm:ss') as date:chararray ; 

--PROCESS useralliance
STOCK_B1 = FILTER STOCK_B BY jointime IS NOT NULL And jointime != 0 and allianceid != 0 ;
STOCK_B2 = FOREACH STOCK_B1 GENERATE uid,allianceid,myudfs.TimestamptoDate(jointime) as joinTime;

--PROCESS playerinfo
STOCK_C1 = FILTER STOCK_C BY uid IS NOT NULL AND createtime IS NOT NULL and level >=28;
STOCK_C2 = FOREACH STOCK_C1 GENERATE uid,level,customname,myudfs.TimestamptoDate(createtime) as createTime; 

--PROCESS uidmapper2
STOCK_D0 = GROUP STOCK_D BY (id,uid);
STOCK_D1 = FOREACH STOCK_D0 GENERATE (chararray)group.$0 as id,group.$1 as uid; 

--JOIN allianceinfo & useralliance
STOCK_A_B = JOIN STOCK_A1 BY id, STOCK_B2 BY allianceid;

--JOIN STOCK_A_B & playerinfo
STOCK_A_B_C = JOIN STOCK_A_B BY uid, STOCK_C2 BY uid;

--JOIN STOCK_A_B_C & uidmapper2
STOCK_A_B_C_D = JOIN STOCK_A_B_C BY $4, STOCK_D1 BY uid;

-- $4 as key,
STOCK_FINAL = FOREACH STOCK_A_B_C_D GENERATE $11 as accid_mem,$3 as date,$3 as date_modify,
(chararray)( ($2==$4)?$6:$3 ) as game_guild_create_date,
CONCAT((chararray)'$ALIAS',CONCAT('_',CONCAT((chararray)$serverid,CONCAT('_',(chararray)$0)))) as game_guild_id,
CONCAT((chararray)'$ALIAS',CONCAT('_',CONCAT((chararray)$serverid,CONCAT('_',(chararray)$1)))) as game_guild_name,
$gameid as game_id,( ($2==$4)?$9:'' ) as leadername,
(chararray)$10 as join_date,
$11 as msi_mem,(chararray)$4 as role_id_mem,(chararray)$9 as role_name,$serverid as server_id;

STORE STOCK_FINAL INTO 'bigdata.bigdata_mgh_temp' USING org.apache.hive.hcatalog.pig.HCatStorer();
/*
STORE STOCK_FINAL INTO 'hbase://bigdata_mgh_temp' USING org.apache.pig.backend.hadoop.hbase.HBaseStorage('info:accid_mem,info:date,info:date_modify,info:game_guild_create_date,info:game_guild_id,info:game_guild_name,info:game_id,info:leadername,info:join_date,info:msi_mem,info:role_id_mem,info:role_name,info:server_id');
*/
