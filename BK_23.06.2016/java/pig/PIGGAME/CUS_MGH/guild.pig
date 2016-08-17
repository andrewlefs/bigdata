register '/home/java/filejar/pigjavamainv2.jar';
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
STOCK_B0 = FILTER STOCK_B BY jointime IS NOT NULL And jointime != 0 and allianceid != 0 ;
STOCK_B1 = FOREACH STOCK_B0 GENERATE uid,myudfs.TimestamptoDate(jointime) as joinTime;

--PROCESS playerinfo
STOCK_C1 = FILTER STOCK_C BY uid IS NOT NULL AND createtime IS NOT NULL and level >=28;
STOCK_C2 = FOREACH STOCK_C1 GENERATE uid,level,customname; 


--PROCESS uidmapper2
STOCK_D0 = GROUP STOCK_D BY (id,uid);
STOCK_D1 = FOREACH STOCK_D0 GENERATE (chararray)group.$0 as id,group.$1 as uid; 

--JOIN allianceinfo & useralliance
STOCK_A_B = JOIN STOCK_A1 BY createrid, STOCK_B1 BY uid;

--JOIN STOCK_A_B & playerinfo
STOCK_A_B_C = JOIN STOCK_A_B BY createrid, STOCK_C2 BY uid;

STORE STOCK_A_B_C INTO 'output/MGH/guild$serverid';
--JOIN STOCK_A_B_C & uidmapper2
STOCK_A_B_C_D = JOIN STOCK_A_B_C BY createrid, STOCK_D1 BY uid;


STOCK_G0 = GROUP STOCK_G BY (mobo_id,mobo_service_id,fullname);
STOCK_G1_1 = FILTER STOCK_G0 BY group.$0 IS NOT NULL And group.$1 IS NOT NULL;
STOCK_G2 = FOREACH STOCK_G1_1 GENERATE group.$0 as mobo_id,(chararray)group.$1 AS mobo_service_id,group.$2 as fullname;


STOCK_A_B_C_D_G = JOIN STOCK_A_B_C_D BY $9, STOCK_G2 BY mobo_service_id;

--INFOMATION NEED
STOCK_FINAL = FOREACH STOCK_A_B_C_D_G GENERATE $3 as date,$3 as date_modify,$gameid as game_id,$serverid as server_id,CONCAT('$ALIAS',CONCAT('_',CONCAT((chararray)$serverid,CONCAT('_',(chararray)$0)))) as game_guild_id,
CONCAT('$ALIAS',CONCAT('_',CONCAT((chararray)$serverid,CONCAT('_',(chararray)$1)))) as game_guild_name,
$5 as game_guild_create_date,(chararray)$8 as game_guild_leader_name,$9 as msi_leader,$11 as mobo_id,(chararray)$13 as fullname,$9 as accid_leader ,(chararray)$2 as role_id_leader;


STORE STOCK_FINAL INTO 'output/MGH/guild1$serverid';
--STORE STOCK_FINAL INTO 'bigdata.guild' USING org.apache.hive.hcatalog.pig.HCatStorer();

