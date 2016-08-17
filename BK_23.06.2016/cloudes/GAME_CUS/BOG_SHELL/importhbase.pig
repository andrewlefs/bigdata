register '/user/yarn/GAME/LIBGAME/pigjavamainv2.jar';
%declare ALIAS 'bog'

STOCK_A = LOAD '$ALIAS.society$serverid' using org.apache.hive.hcatalog.pig.HCatLoader() ;
STOCK_B = LOAD '$ALIAS.societymem$serverid' using org.apache.hive.hcatalog.pig.HCatLoader() ;
STOCK_C = LOAD '$ALIAS.roles$serverid' using org.apache.hive.hcatalog.pig.HCatLoader() ; 

--PROCESS society
STOCK_A1 = FOREACH STOCK_A GENERATE myudfs.ToJson(myudfs.TestHex(guid)) as guild,
myudfs.ToJson(myudfs.TestHex(name)) as name,
myudfs.ToJson(myudfs.TestHex(leaderguid)) as leaderguid,
myudfs.ToJson(myudfs.TestHex(leadername)) as leadername,
createtime,
ToString(CurrentTime(),'yyyy-MM-dd HH:mm:ss') as date:chararray ; 

--PROCESS societymem
STOCK_B1 = FILTER STOCK_B BY jointime IS NOT NULL ;
STOCK_B2 = FOREACH STOCK_B1 GENERATE myudfs.ToJson(myudfs.TestHex(roleguid)) as roleguid,
myudfs.ToJson(myudfs.TestHex(societyguid)) as societyguid,
( (jointime IS NOT NULL ) ? jointime : ToString(CurrentTime(),'yyyy-MM-dd HH:mm:ss') ) as jointime:chararray; 


--PROCESS role

STOCK_C1_0 = FOREACH STOCK_C GENERATE myudfs.ToJson(myudfs.TestHex(guid)) as guildid,
accid,myudfs.ToJson(myudfs.TestHex(accountname)) AS id,roleid,rolelevel,
myudfs.ToJson(myudfs.TestHex(rolename)) as rolename,createdate,( (lastplayingdate IS NOT NULL ) ? lastplayingdate : createdate) as LastLogin; 

STOCK_C1 = FILTER STOCK_C1_0 BY $4 >=20 and $0 IS NOT NULL;


--JOIN society & societymem
STOCK_A_B = JOIN STOCK_A1 BY guild, STOCK_B2 BY societyguid;

--JOIN STOCK_A_B & role
STOCK_A_B_C = JOIN STOCK_A_B BY roleguid, STOCK_C1 BY guildid;


STOCK_F_DONE = JOIN STOCK_A_B_C BY roleguid LEFT OUTER, STOCK_A1 BY leaderguid;

--$6 as key,
STOCK_FINAL = FOREACH STOCK_F_DONE GENERATE $11 as accid_mem,$5 as date,$5 as date_modify,
(chararray)$4 as game_guild_create_date,
CONCAT((chararray)'$ALIAS',CONCAT('_',CONCAT((chararray)$serverid,CONCAT('_',(chararray)$0)))) as game_guild_id,
CONCAT((chararray)'$ALIAS',CONCAT('_',CONCAT((chararray)$serverid,CONCAT('_',(chararray)$1)))) as game_guild_name,
$gameid as game_id,(chararray)$3 as leadername,
(chararray)$8 as join_date,
$11 as msi_mem,(chararray)$6 as role_id_mem,(chararray)$14 as role_name,$serverid as server_id;

STORE STOCK_FINAL INTO 'bigdata.bigdata_bog_temp' USING org.apache.hive.hcatalog.pig.HCatStorer();
/*
STORE STOCK_FINAL INTO 'hbase://bigdata_bog_temp' USING org.apache.pig.backend.hadoop.hbase.HBaseStorage('info:accid_mem,info:date,info:date_modify,info:game_guild_create_date,info:game_guild_id,info:game_guild_name,info:game_id,info:leadername,info:join_date,info:msi_mem,info:role_id_mem,info:role_name,info:server_id');
*/
