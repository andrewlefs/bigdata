register '/usr/hdp/2.3.4.0-3485/pig/lib/mysql-connector-java-5.1.34.jar';
register '/usr/hdp/2.3.4.0-3485/pig/lib/piggybank.jar';
register '/home/java/filejar/pigjavamain.jar';

STOCK_D = LOAD 'acdau.t_zhanghao$serverid' using org.apache.hive.hcatalog.pig.HCatLoader() AS (third_uname,guid);

--START PROCCESS

--PROCESS t_zhanghao
STOCK_D1 = FOREACH STOCK_D GENERATE $0,$1,ToString(CurrentTime(),'yyyy-MM-dd HH:mm:ss') as date:chararray; 

--INFOMATION NEED
STOCK_FINAL = FOREACH STOCK_D1 GENERATE $2 as date,$gameid,$0 as msi,$0 as accid_mem;
