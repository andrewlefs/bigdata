register '/usr/hdp/2.3.4.0-3485/pig/lib/mysql-connector-java.jar';
register '/usr/hdp/2.3.4.0-3485/pig/lib/piggybank.jar';
register '/home/java/filejar/pigjavamain.jar';

STOCK_A = LOAD 'bigdata.guild' using org.apache.hive.hcatalog.pig.HCatLoader(); 
STORE STOCK_A INTO 'output/CTT/guildtestall';
