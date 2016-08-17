register '/usr/hdp/2.3.4.0-3485/pig/lib/mysql-connector-java.jar';
register '/usr/hdp/2.3.4.0-3485/pig/lib/piggybank.jar';
STOCK_A = LOAD 'test_import_hive' USING org.apache.pig.piggybank.storage.DBStorage('com.mysql.jdbc.Driver', 'jdbc:mysql://localhost/test','hiennv','dklp', 'SELECT * FROM test_import_hive');
DUMP STOCK_A;