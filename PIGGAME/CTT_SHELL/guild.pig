register '/usr/hdp/2.3.4.0-3485/pig/lib/mysql-connector-java-5.1.34.jar';
register '/usr/hdp/2.3.4.0-3485/pig/lib/piggybank.jar';
register '/home/java/filejar/pigjavamain.jar';
%declare ALIAS 'ctt'
STOCK_A = LOAD '$ALIAS.t_juntuan$serverid' using org.apache.hive.hcatalog.pig.HCatLoader() ;
--AS (id:int,str_name:chararray,dt_create:chararray,chuang_jian_zhe:int)
STOCK_B = LOAD '$ALIAS.t_juntuan_chengyuan$serverid' using org.apache.hive.hcatalog.pig.HCatLoader() ;
--AS (str_name,juntuan_id,dt_rutuan_time,jue_se)
STOCK_C = LOAD '$ALIAS.t_juese$serverid' using org.apache.hive.hcatalog.pig.HCatLoader() ; 
--AS (zhang_hao,str_name,dt_chuangjian_time,dt_shangci_denglv,deng_ji,guid)
STOCK_D = LOAD '$ALIAS.t_zhanghao' using org.apache.hive.hcatalog.pig.HCatLoader() ;
--AS (third_uname,guid)

STOCK_G = LOAD 'graph_mobo_vn.account_service_$gameid' using org.apache.hive.hcatalog.pig.HCatLoader(); 

--START PROCCESS

--PROCESS t_juntuan
STOCK_A1 = FOREACH STOCK_A GENERATE id,str_name,dt_create,chuang_jian_zhe,ToString(CurrentTime(),'yyyy-MM-dd HH:mm:ss') as date:chararray ; 
--PROCESS t_juntuan_chengyuan


STOCK_B1 = FOREACH STOCK_B GENERATE str_name,juntuan_id,dt_rutuan_time,jue_se ; 
--PROCESS t_juese
STOCK_C1 = FOREACH STOCK_C GENERATE zhang_hao,str_name,dt_chuangjian_time,dt_shangci_denglv,deng_ji,guid; 
--PROCESS t_zhanghao

STOCK_D1 = GROUP STOCK_D BY (third_uname,guid); 

STOCK_D2 = FOREACH STOCK_D1 GENERATE group.third_uname as third_uname,group.guid as guid; 
--JOIN t_juntuan & t_juntuan_chengyuan
STOCK_A_B = JOIN STOCK_A1 BY chuang_jian_zhe, STOCK_B1 BY jue_se;

--JOIN STOCK_A_B & t_juese
STOCK_A_B_C = JOIN STOCK_A_B BY chuang_jian_zhe, STOCK_C1 BY guid;
--JOIN STOCK_A_B_C & t_zhanghao
-- GROUP BY GUILD

STOCK_A_B_C_D = JOIN STOCK_A_B_C BY zhang_hao, STOCK_D2 BY guid;


STOCK_G1 = GROUP STOCK_G BY (mobo_id,mobo_service_id,fullname); 
STOCK_G2 = FOREACH STOCK_G1 GENERATE group.mobo_id as mobo_id,(chararray)group.mobo_service_id,group.fullname as fullname ; 

STOCK_A_B_C_D_G = JOIN STOCK_A_B_C_D BY third_uname, STOCK_G2 BY $1;

--INFOMATION NEED
STOCK_FINAL = FOREACH STOCK_A_B_C_D_G GENERATE $4 as date,$4 as date_modify,$gameid as game_id,$serverid as server_id,CONCAT((chararray)'$ALIAS',CONCAT('_',CONCAT((chararray)$serverid,CONCAT('_',(chararray)$0)))) as game_guild_id,CONCAT((chararray)'$ALIAS',CONCAT('_',CONCAT((chararray)$serverid,CONCAT('_',(chararray)$1)))) as game_guild_name,$2 as game_guild_create_date,$5 as game_guild_leader_name,$15 as msi_leader,$17 as mobo_id,$19 as fullname,$15 as accid_leader ,(chararray)$3 as role_id_leader;

STORE STOCK_FINAL INTO 'bigdata.guild' USING org.apache.hive.hcatalog.pig.HCatStorer();
--STORE STOCK_FINAL INTO 'guild' USING org.apache.pig.piggybank.storage.DBStorage('com.mysql.jdbc.Driver','jdbc:mysql://10.10.20.13/datawarehouse','mapreduce','0XfAWJwiwb','INSERT INTO guild(`date` ,`date_modify` ,`game_id`,`server_id`,`game_guild_id`,`game_guild_name`,`game_guild_create_date`,`game_guild_leader_name`,`msi_leader`,`accid_leader`,`role_id_leader`) VALUES(?,?,?,?,?,?,?,?,?,?,?) ON DUPLICATE KEY UPDATE `date_modify` = ?');
