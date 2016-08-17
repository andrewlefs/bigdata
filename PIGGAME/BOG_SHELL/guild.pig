register '/usr/hdp/2.3.4.0-3485/pig/lib/mysql-connector-java-5.1.34.jar';
register '/usr/hdp/2.3.4.0-3485/pig/lib/piggybank.jar';
register '/home/java/filejar/pigjavamain.jar';
%declare ALIAS 'bog'
STOCK_A = LOAD '$ALIAS.society$serverid' using org.apache.hive.hcatalog.pig.HCatLoader() ;
STOCK_C = LOAD '$ALIAS.roleS$serverid' using org.apache.hive.hcatalog.pig.HCatLoader() ; 

STOCK_G = LOAD 'graph_mobo_vn.account_service_$gameid' using org.apache.hive.hcatalog.pig.HCatLoader(); 

--START PROCCESS

--PROCESS society
STOCK_A1 = FOREACH STOCK_A GENERATE myudfs.ToJson(myudfs.TestHex(guid)) as guild,myudfs.ToJson(myudfs.TestHex(name)) as name,myudfs.ToJson(myudfs.TestHex(leaderguid)) as leaderguid,myudfs.ToJson(myudfs.TestHex(leadername)) as leadername,createtime,ToString(CurrentTime(),'yyyy-MM-dd HH:mm:ss') as date:chararray ; 
DUMP STOCK_A1;
/*
--PROCESS role
STOCK_C1 = FOREACH STOCK_C GENERATE myudfs.ToJson(myudfs.TestHex(guid)) as guildid,accid,myudfs.ToJson(myudfs.TestHex(accountname)) AS id,roleid,rolelevel,myudfs.ToJson(myudfs.TestHex(rolename)) as rolename,createdate,( (lastplayingdate IS NOT NULL ) ? lastplayingdate : createdate) as LastLogin; 

--JOIN society & role
STOCK_A_C = JOIN STOCK_A1 BY leaderguid, STOCK_C1 BY guildid;

STOCK_G1 = FOREACH STOCK_G GENERATE mobo_id,(chararray)$2 AS mobo_service_id,fullname; 
STOCK_A_C_G = JOIN STOCK_A_C BY id, STOCK_G1 BY mobo_service_id;

--INFOMATION NEED
STOCK_FINAL = FOREACH STOCK_A_C_G GENERATE $5 as date,$5 as date_modify,$gameid as game_id,$serverid as server_id,CONCAT('$ALIAS',CONCAT('_',CONCAT((chararray)$serverid,CONCAT('_',(chararray)$0)))) as game_guild_id,CONCAT('$ALIAS',CONCAT('_',CONCAT((chararray)$serverid,CONCAT('_',(chararray)$1)))) as game_guild_name,$4 as game_guild_create_date,$3 as game_guild_leader_name,$8 as msi_leader,$14 as mobo_id,$16 as fullname,$8 as accid_leader ,(chararray)$9 as role_id_leader;
DUMP STOCK_FINAL;
--STORE STOCK_FINAL INTO 'output/BOG/guild$serverid';

STORE STOCK_FINAL INTO 'bigdata.guild' USING org.apache.hive.hcatalog.pig.HCatStorer();
--STORE STOCK_FINAL INTO 'guild' USING org.apache.pig.piggybank.storage.DBStorage('com.mysql.jdbc.Driver','jdbc:mysql://10.10.20.13/datawarehouse','mapreduce','0XfAWJwiwb','INSERT INTO guild(`date` ,`date_modify` ,`game_id`,`server_id`,`game_guild_id`,`game_guild_name`,`game_guild_create_date`,`game_guild_leader_name`,`msi_leader`,`accid_leader`,`role_id_leader`) VALUES(?,?,?,?,?,?,?,?,?,?,?) ON DUPLICATE KEY UPDATE `date_modify` = ?');
*/