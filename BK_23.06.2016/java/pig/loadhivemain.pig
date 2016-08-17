register '/usr/hdp/2.3.4.0-3485/pig/lib/mysql-connector-java-5.1.34.jar';
register '/usr/hdp/2.3.4.0-3485/pig/lib/piggybank.jar';
register '/home/java/filejar/pigjavamain.jar';
STOCK_A  = LOAD 'tieuhiep.army1' using org.apache.hive.hcatalog.pig.HCatLoader();
STOCK_C = LIMIT STOCK_A 5; 
STOCK_D = FOREACH STOCK_C GENERATE army_id,myudfs.TOHEX(army_attr),myudfs.TOHEX(army_member),myudfs.TOHEX(army_building_attr); 
STORE STOCK_D INTO 'output/test1';
DUMP STOCK_D;