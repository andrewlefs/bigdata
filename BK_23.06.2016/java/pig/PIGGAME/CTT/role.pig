register '/usr/hdp/2.3.4.0-3485/pig/lib/mysql-connector-java-5.1.34.jar';
register '/usr/hdp/2.3.4.0-3485/pig/lib/piggybank.jar';
register '/home/java/filejar/pigjavamain.jar';

STOCK_C = LOAD 'ctt.t_juese$serverid' using org.apache.hive.hcatalog.pig.HCatLoader();
STOCK_D = LOAD 'ctt.t_zhanghao' using org.apache.hive.hcatalog.pig.HCatLoader();
STOCK_G = LOAD 'graph_mobo_vn.account_service_$gameid' using org.apache.hive.hcatalog.pig.HCatLoader(); 
--START PROCCESS

--PROCESS t_juese
STOCK_C1 = FOREACH STOCK_C GENERATE zhang_hao,str_name,dt_chuangjian_time,dt_shangci_denglv,deng_ji,guid,ToString(CurrentTime(),'yyyy-MM-dd HH:mm:ss') as date:chararray ; 

--PROCESS t_zhanghao
STOCK_D1 = FOREACH STOCK_D GENERATE (chararray)third_uname AS third_uname,guid; 

--JOIN t_juntuan & t_juntuan_chengyuan
STOCK_C_D = JOIN STOCK_C1 BY zhang_hao LEFT OUTER, STOCK_D1 BY guid;

STOCK_G1 = FOREACH STOCK_G GENERATE mobo_id,(chararray)$2 AS mobo_service_id,fullname ; 

STOCK_C_D_G = JOIN STOCK_C_D BY third_uname, STOCK_G1 BY mobo_service_id;


--INFOMATION NEED
--STOCK_FINAL = FOREACH STOCK_C_D GENERATE $6 as date,$6 as date_modify,$gameid as game_id,$serverid as server_id,$7 as accid,$7 as msi,$5 as role_id,$1 as role_name,$2 as create_role_date,$3 as dt_shangci_denglv,$4 as level;

STOCK_FINAL = FOREACH STOCK_C_D_G GENERATE $6 as date,$6 as date_modify,$gameid as game_id,$serverid as server_id,$7 as accid,$7 as msi,$9 as mobo_id,(chararray)$11 as fullname,(chararray)$5 as role_id,$1 as role_name,$2 as create_role_date,$3 as last_login_date,$4 as level;
--STORE STOCK_FINAL INTO 'output/CTT/role1';
STORE STOCK_FINAL INTO 'bigdata.role' USING org.apache.hive.hcatalog.pig.HCatStorer();
