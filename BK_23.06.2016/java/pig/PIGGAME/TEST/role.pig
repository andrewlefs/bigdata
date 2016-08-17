register '/home/java/filejar/pigjavamain.jar';
STOCK_C = LOAD 'tieuhiep.role_brief$serverid' using org.apache.hive.hcatalog.pig.HCatLoader(); 
DESCRIBE STOCK_C;
