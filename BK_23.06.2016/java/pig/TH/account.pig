register '/usr/hdp/2.3.4.0-3485/pig/lib/mysql-connector-java-5.1.34.jar';
register '/usr/hdp/2.3.4.0-3485/pig/lib/piggybank.jar';
register '/home/java/filejar/json-simple-1.1.jar';
register '/home/java/filejar/pigjava.jar';

STOCK_D = LOAD 'tieuhiep.role_name_map$serverid' using org.apache.hive.hcatalog.pig.HCatLoader() AS (idrole_name_map,role_id,role_name,plat_user_name,ditch_name); 

--PROCESS role_name_map
STOCK_D2 = FOREACH STOCK_D GENERATE $0 as idrole_name_map,$1 as role_id,myudfs.TestHex($2) as role_name,FLATTEN(STRSPLIT(myudfs.TestHex($3), '_')) as (a1:chararray, plat_user_name:chararray), ToString(CurrentTime(),'yyyy-MM-dd HH:mm:ss') as date:chararray; 
--INFOMATION NEED
STOCK_FINAL = FOREACH STOCK_D2 GENERATE $5 as date,$gameid,$4 as msi,$4 as accid_mem,$5 as date_new;

STORE STOCK_FINAL INTO 'account' USING org.apache.pig.piggybank.storage.DBStorage('com.mysql.jdbc.Driver','jdbc:mysql://10.10.20.13/datawarehouse','mapreduce','0XfAWJwiwb','INSERT INTO account(`date`,`game_id` ,`accid`,`msi`) VALUES(?,?,?,?) ON DUPLICATE KEY UPDATE `date` = ?');
