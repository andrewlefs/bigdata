register '/usr/hdp/2.3.4.0-3485/pig/lib/mysql-connector-java-5.1.34.jar';
register '/usr/hdp/2.3.4.0-3485/pig/lib/piggybank.jar';
register '/home/java/filejar/pigjavamain.jar';

STOCK_A = LOAD 'tieuhiep.army$serverid' using org.apache.hive.hcatalog.pig.HCatLoader() AS (army_id,army_attr,army_member,army_building_attr:chararray);
STOCK_B = LOAD 'tieuhiep.army_brief$serverid' using org.apache.hive.hcatalog.pig.HCatLoader(); 
STOCK_D = LOAD 'tieuhiep.role_name_map$serverid' using org.apache.hive.hcatalog.pig.HCatLoader() AS (idrole_name_map,role_id,role_name,plat_user_name,ditch_name); 

--START PROCCESS
STOCK_A1 = FOREACH STOCK_A GENERATE $0,myudfs.JsonMap(myudfs.ToJson(myudfs.TestHex($1))) as army_attr,myudfs.TestHex($2) as army_member,myudfs.TestHex($3) as army_building_attr, ToString(CurrentTime(),'yyyy-MM-dd HH:mm:ss') as date:chararray ; 
STOCK_A2 = FOREACH STOCK_A1 GENERATE $0,army_attr#'create_time' as create_time,date ; 
--PROCESS army_brief
STOCK_B2 = FOREACH STOCK_B GENERATE $0 as idarmy_brief,$1 as army_id,myudfs.TestHex($2) as army_name,$3 as army_level,$8 as leader_id,myudfs.TestHex($9) as leader_name ; 
--PROCESS role_name_map
STOCK_D2 = FOREACH STOCK_D GENERATE $0 as idrole_name_map,$1 as role_id,myudfs.TestHex($2) as role_name,FLATTEN(STRSPLIT(myudfs.TestHex($3), '_')) as (a1:chararray, plat_user_name:chararray),myudfs.TestHex($4) as ditch_name; 

--JOIN army_brief & role_name_map
STOCK_B_D = JOIN STOCK_B2 BY leader_id LEFT OUTER, STOCK_D2 BY role_id;

--JOIN STOCK_B_D & army
STOCK_B_D_A = JOIN STOCK_B_D BY army_id LEFT OUTER, STOCK_A2 BY army_id;

--INFOMATION NEED
STOCK_FINAL = FOREACH STOCK_B_D_A GENERATE AUTO_INCREMENT_ID,$14 as date,$14 as date_modify,$gameid as game_id,$serverid as server_id,CONCAT((chararray)$gameid,CONCAT('_',CONCAT((chararray)$serverid,CONCAT('_',(chararray)$0)))) as game_guild_id,CONCAT((chararray)$gameid,CONCAT('_',CONCAT((chararray)$serverid,CONCAT('_',(chararray)$2)))) as game_guild_name,myudfs.TimestamptoDate($13) as game_guild_create_date,$5 as game_guild_leader_name,$10 as msi_leader,$10 as accid_leader ,$4 as role_id_leader;
DUMP STOCK_FINAL;
--STORE STOCK_FINAL INTO 'bigdata.guild' USING org.apache.hive.hcatalog.pig.HCatStorer();
--STORE STOCK_FINAL INTO 'guild' USING org.apache.pig.piggybank.storage.DBStorage('com.mysql.jdbc.Driver','jdbc:mysql://10.10.20.13/datawarehouse','mapreduce','0XfAWJwiwb','INSERT INTO guild(`date` ,`date_modify` ,`game_id`,`server_id`,`game_guild_id`,`game_guild_name`,`game_guild_create_date`,`game_guild_leader_name`,`msi_leader`,`accid_leader`,`role_id_leader`) VALUES(?,?,?,?,?,?,?,?,?,?,?) ON DUPLICATE KEY UPDATE `date_modify` = ?');
