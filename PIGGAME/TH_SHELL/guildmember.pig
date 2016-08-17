register '/usr/hdp/2.3.4.0-3485/pig/lib/mysql-connector-java-5.1.34.jar';
register '/usr/hdp/2.3.4.0-3485/pig/lib/piggybank.jar';
register '/home/java/filejar/json-simple-1.1.jar';
register '/home/java/filejar/pigjava.jar';
%declare ALIAS 'tieuhiep';
%declare ALIASGAME 'th';
STOCK_A = LOAD '$ALIAS.army$serverid' using org.apache.hive.hcatalog.pig.HCatLoader() AS (army_id,army_attr,army_member,army_building_attr:chararray);
STOCK_D = LOAD '$ALIAS.role_name_map$serverid' using org.apache.hive.hcatalog.pig.HCatLoader() AS (idrole_name_map,role_id,role_name,plat_user_name,ditch_name); 
STOCK_G = LOAD 'graph_mobo_vn.account_service_$gameid' using org.apache.hive.hcatalog.pig.HCatLoader(); 

--PROCESS army
STOCK_A1 = FOREACH STOCK_A GENERATE  $0,myudfs.JsonMap(myudfs.ToJson(myudfs.TestHex($1))) as army_attr,myudfs.LibMember(myudfs.LibMenTH(myudfs.TestHex($2))) as army_member,myudfs.TestHex($3) as army_building_attr, ToString(CurrentTime(),'yyyy-MM-dd HH:mm:ss') as date:chararray; 
STOCK_A2 = FOREACH STOCK_A1 GENERATE $0,$1,FLATTEN($2#'value'),$4; 
--DUMP STOCK_A2 ;

--PROCESS role_name_map
--STOCK_D1 = LIMIT STOCK_D 5; 
STOCK_D2 = FOREACH STOCK_D GENERATE $0 as idrole_name_map,$1 as role_id,myudfs.TestHex($2) as role_name,FLATTEN(STRSPLIT(myudfs.TestHex($3), '_')) as (a1:chararray, plat_user_name:chararray); 
--DUMP STOCK_D2;

STOCK_G1 = FOREACH STOCK_G GENERATE mobo_id,(chararray)$2 AS mobo_service_id,fullname ; 

--JOIN army_brief & role_name_map
STOCK_A_D = JOIN STOCK_A2 BY $2#'member_role_id' LEFT OUTER, STOCK_D2 BY role_id;
--DUMP STOCK_A_D;

STOCK_A_D_G = JOIN STOCK_A_D BY $8 LEFT OUTER, STOCK_G1 BY mobo_service_id;

--INFOMATION NEED
--STOCK_FINAL = FOREACH STOCK_B_D_A GENERATE $14 as date,$14 as date_modify,$gameid as game_id,$serverid as server_id,CONCAT((chararray)$gameid,CONCAT((chararray)$serverid,$0)) as game_guild_id,CONCAT((chararray)$gameid,CONCAT((chararray)$serverid,$2)) as game_guild_name,myudfs.TimestamptoDate($13) as game_guild_create_date,$5 as game_guild_leader_name,$10 as msi_leader,$10 as accid_leader,$4 as role_id_leader;
STOCK_FINAL = FOREACH STOCK_A_D_G GENERATE CONCAT((chararray)'$ALIASGAME',CONCAT('_',CONCAT((chararray)$serverid,CONCAT('_',(chararray)$0)))) as game_guild_id,$3 as date,myudfs.TimestamptoDate($2#'join_time') as join_date,$8 as msi_mem,$8 as accid_mem,$9 as mobo_id,(chararray)$11 as fullname,(chararray)$2#'member_role_id' as role_id_mem,0 as statussend;

STORE STOCK_FINAL INTO 'bigdata.guild_member' USING org.apache.hive.hcatalog.pig.HCatStorer();
--STORE STOCK_FINAL INTO 'guild_member' USING org.apache.pig.piggybank.storage.DBStorage('com.mysql.jdbc.Driver','jdbc:mysql://10.10.20.13/datawarehouse','mapreduce','0XfAWJwiwb','INSERT INTO guild_member(`game_guild_id` ,`date`,`join_date` ,`msi_mem`,`accid_mem`,`role_id_mem`) VALUES(?,?,?,?,?,?) ON DUPLICATE KEY UPDATE `date` = ?');
