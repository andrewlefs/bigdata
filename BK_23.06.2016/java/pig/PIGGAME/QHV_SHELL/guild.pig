register '/home/java/filejar/protobuf-java-2.6.1.jar';
register '/home/java/filejar/pigjavamainv2.jar';

%declare ALIAS 'qhv';

STOCK_A = LOAD '$ALIAS.player$serverid' using org.apache.hive.hcatalog.pig.HCatLoader() ;
STOCK_B = LOAD '$ALIAS.gang$serverid' using org.apache.hive.hcatalog.pig.HCatLoader() ;
STOCK_G = LOAD 'graph_mobo_vn.account_service_$gameid' using org.apache.hive.hcatalog.pig.HCatLoader(); 

STOCK_A1 = FILTER STOCK_A BY $2 IS NOT NULL;
STOCK_A2 = FOREACH STOCK_A1 GENERATE $0 as id,$1 as userid,FLATTEN(STRSPLIT($2, '_')) as (a1:chararray, msi:chararray),
$4 as name,$5 as lv,$6 as createdate,$7 as logindate,
ToString(CurrentTime(),'yyyy-MM-dd HH:mm:ss') as date:chararray ;

STOCK_B1 = FOREACH STOCK_B GENERATE id,myudfs.ParseprotoQHV(protodata) as proto;

STOCK_A_B = JOIN STOCK_A2 BY $0, STOCK_B1 BY $1#'roleid';

STOCK_G1 = GROUP STOCK_G BY (mobo_id,mobo_service_id,fullname);
STOCK_G2 = FOREACH STOCK_G1 GENERATE group.mobo_id,(chararray)group.mobo_service_id AS mobo_service_id,group.fullname as fullname ;

STOCK_A_B_G = JOIN STOCK_A_B BY $3, STOCK_G2 BY $1;
--INFOMATION NEED
STOCK_FINAL = FOREACH STOCK_A_B_G GENERATE $8 as date,$8 as date_modify,
$gameid as game_id,$serverid as server_id,
CONCAT('$ALIAS',CONCAT('_',CONCAT((chararray)$serverid,CONCAT('_',(chararray)$9)))) as game_guild_id,
CONCAT('$ALIAS',CONCAT('_',CONCAT((chararray)$serverid,CONCAT('_',(chararray)$10#'guildname')))) as game_guild_name,
myudfs.UnixtimetoDate($10#'guildcreatedate') as game_guild_create_date,(chararray)$4 as game_guild_leader_name,
$12 as msi_leader,$11 as mobo_id,(chararray)$13 as fullname,
$12 as accid_leader ,(chararray)$0 as role_id_leader;

dump STOCK_FINAL;
/*
DUMP STOCK_B1;
--STORE STOCK_A2 INTO 'output/QHV/testgang';
*/
