register '/user/yarn/GAME/LIBGAME/pigjavamainv2.jar';
%declare ALIAS 'ctt';

STOCK_C = LOAD '$ALIAS.t_juese$serverid' using org.apache.hive.hcatalog.pig.HCatLoader();
STOCK_D = LOAD '$ALIAS.t_zhanghao' using org.apache.hive.hcatalog.pig.HCatLoader();
STOCK_G = LOAD 'graph_mobo_vn.account_service_$gameid' using org.apache.hive.hcatalog.pig.HCatLoader(); 
--START PROCCESS

--PROCESS t_juese
STOCK_C1 = FOREACH STOCK_C GENERATE zhang_hao,str_name,dt_chuangjian_time,dt_shangci_denglv,deng_ji,guid,ToString(CurrentTime(),'yyyy-MM-dd HH:mm:ss') as date:chararray ; 

--PROCESS t_zhanghao
STOCK_D1 = GROUP STOCK_D BY (third_uname,guid); 

STOCK_D2 = FOREACH STOCK_D1 GENERATE group.third_uname as third_uname,group.guid as guid; 


--JOIN t_juntuan & t_juntuan_chengyuan
STOCK_C_D = JOIN STOCK_C1 BY zhang_hao, STOCK_D2 BY guid;

STOCK_G1 = GROUP STOCK_G BY (mobo_id,mobo_service_id,fullname); 
STOCK_G2 = FOREACH STOCK_G1 GENERATE group.mobo_id as mobo_id,(chararray)group.mobo_service_id,group.fullname as fullname ; 

STOCK_C_D_G = JOIN STOCK_C_D BY third_uname, STOCK_G2 BY $1;


--INFOMATION NEED

STOCK_FINAL = FOREACH STOCK_C_D_G GENERATE $6 as date,$6 as date_modify,$gameid as game_id,$serverid as server_id,$7 as accid,$7 as msi,$9 as mobo_id,(chararray)$11 as fullname,(chararray)$5 as role_id,(chararray)$1 as role_name,$2 as create_role_date,$3 as last_login_date,$4 as level;

STORE STOCK_FINAL INTO 'bigdata.role' USING org.apache.hive.hcatalog.pig.HCatStorer();
