register '/usr/hdp/2.3.4.0-3485/pig/lib/mysql-connector-java-5.1.34.jar';
register '/usr/hdp/2.3.4.0-3485/pig/lib/piggybank.jar';
register '/home/java/filejar/pigjavamain.jar';

STOCK_C = LOAD 'acdau.t_juese$serverid' using org.apache.hive.hcatalog.pig.HCatLoader();
STOCK_D = LOAD 'acdau.t_zhanghao$serverid' using org.apache.hive.hcatalog.pig.HCatLoader();

--START PROCCESS

--PROCESS t_juese
STOCK_C1 = FOREACH STOCK_C GENERATE zhang_hao,str_name,dt_chuangjian_time,dt_shangci_denglv,deng_ji,guid,ToString(CurrentTime(),'yyyy-MM-dd HH:mm:ss') as date:chararray ; 
--PROCESS t_zhanghao
STOCK_D1 = FOREACH STOCK_D GENERATE third_uname,guid; 

--JOIN t_juntuan & t_juntuan_chengyuan
STOCK_C_D = JOIN STOCK_C1 BY zhang_hao LEFT OUTER, STOCK_D1 BY guid;

--INFOMATION NEED
STOCK_FINAL = FOREACH STOCK_C_D GENERATE $6 as date,$6 as date_modify,$gameid as game_id,$serverid as server_id,$7 as accid,$7 as msi,$5 as role_id,$1 as role_name,$2 as create_role_date,$3 as dt_shangci_denglv,$4 as level;


