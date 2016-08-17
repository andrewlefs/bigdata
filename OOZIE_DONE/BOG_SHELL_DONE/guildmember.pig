register '/home/java/filejar/pigjavamainv2.jar';
%declare ALIAS 'bog'

STOCK_A = LOAD '$ALIAS.society$serverid' using org.apache.hive.hcatalog.pig.HCatLoader() ;
STOCK_B = LOAD '$ALIAS.societymem$serverid' using org.apache.hive.hcatalog.pig.HCatLoader() ;
STOCK_C = LOAD '$ALIAS.roles$serverid' using org.apache.hive.hcatalog.pig.HCatLoader() ; 

STOCK_G = LOAD 'graph_mobo_vn.account_service_$gameid' using org.apache.hive.hcatalog.pig.HCatLoader(); 

--START PROCCESS
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

STOCK_G0 = GROUP STOCK_G BY (mobo_id,mobo_service_id,fullname);
STOCK_G1_1 = FILTER STOCK_G0 BY group.$0 IS NOT NULL And group.$1 IS NOT NULL;
STOCK_G2 = FOREACH STOCK_G1_1 GENERATE group.$0 as mobo_id,(chararray)group.$1 AS mobo_service_id,group.$2 as fullname;


STOCK_A_B_C_G = JOIN STOCK_A_B_C BY id, STOCK_G2 BY mobo_service_id;

--INFOMATION NEED
STOCK_FINAL = FOREACH STOCK_A_B_C_G GENERATE CONCAT('$ALIAS',CONCAT('_',CONCAT((chararray)$serverid,CONCAT('_',(chararray)$0)))) as game_guild_id,$5 as date,$8 as join_date,$11 as msi_mem,$11 as accid_mem,$17 as mobo_id,(chararray)$19 as fullname,(chararray)$12 as role_id_mem,0 as statussend;
STORE STOCK_FINAL INTO 'output/BOG/guildmember$serverid';
--STORE STOCK_FINAL INTO 'bigdata.guild_member' USING org.apache.hive.hcatalog.pig.HCatStorer();
--STORE STOCK_FINAL INTO 'guild' USING org.apache.pig.piggybank.storage.DBStorage('com.mysql.jdbc.Driver','jdbc:mysql://10.10.20.13/datawarehouse','mapreduce','0XfAWJwiwb','INSERT INTO guild(`date` ,`date_modify` ,`game_id`,`server_id`,`game_guild_id`,`game_guild_name`,`game_guild_create_date`,`game_guild_leader_name`,`msi_leader`,`accid_leader`,`role_id_leader`) VALUES(?,?,?,?,?,?,?,?,?,?,?) ON DUPLICATE KEY UPDATE `date_modify` = ?');
