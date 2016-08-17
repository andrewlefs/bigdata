register '/usr/hdp/2.3.4.0-3485/pig/lib/mysql-connector-java-5.1.34.jar';
register '/usr/hdp/2.3.4.0-3485/pig/lib/piggybank.jar';
STOCK_A  = LOAD 'default.test_employees' using org.apache.hive.hcatalog.pig.HCatLoader();
STOCK_B = LIMIT STOCK_A 5; 
STOCK_C = FOREACH STOCK_B GENERATE exchange,date,symbol,open; 
STORE STOCK_C INTO 'test_import_hive' USING org.apache.pig.piggybank.storage.DBStorage('com.mysql.jdbc.Driver','jdbc:mysql://Bigdata-Mobo-Master/test','dklp','dklp','INSERT INTO test_import_hive(exchange,date,symbol,open) VALUES(?,?,?,?)');