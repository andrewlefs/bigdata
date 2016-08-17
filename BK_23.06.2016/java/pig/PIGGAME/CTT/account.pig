register '/usr/hdp/2.3.4.0-3485/pig/lib/mysql-connector-java-5.1.34.jar';
register '/usr/hdp/2.3.4.0-3485/pig/lib/piggybank.jar';
register '/home/java/filejar/pigjavamain.jar';

STOCK_D = LOAD 'ctt.t_zhanghao' using org.apache.hive.hcatalog.pig.HCatLoader();
STOCK_G = LOAD 'graph_mobo_vn.account_service_$gameid' using org.apache.hive.hcatalog.pig.HCatLoader(); 
--START PROCCESS

--PROCESS t_zhanghao
STOCK_D1 = FOREACH STOCK_D GENERATE third_uname,guid,ToString(CurrentTime(),'yyyy-MM-dd HH:mm:ss') as date:chararray; 

STOCK_G1 = FOREACH STOCK_G GENERATE mobo_id,(chararray)$2 AS mobo_service_id,fullname ;
 
STOCK_D_G = JOIN STOCK_D1 BY third_uname, STOCK_G1 BY mobo_service_id ;
--INFOMATION NEED
STOCK_FINAL = FOREACH STOCK_D_G GENERATE $2 as date,$gameid as game_id,$0 as accid,$0 as msi,$3 as mobo_id,(chararray)$5 as fullname;
--STORE STOCK_FINAL INTO 'output/CTT/account1';
STORE STOCK_FINAL INTO 'bigdata.account' USING org.apache.hive.hcatalog.pig.HCatStorer();
