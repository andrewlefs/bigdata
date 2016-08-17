register '/usr/hdp/2.3.4.0-3485/pig/lib/mysql-connector-java.jar';
--register '/usr/hdp/2.3.4.0-3485/pig/lib/piggybank.jar';
register '/home/java/pig/piggybank-0.11.0.jar';

STOCK_A = LOAD 'brave.users' USING org.apache.pig.piggybank.storage.DBStorage('com.mysql.jdbc.Driver','jdbc:mysql://10.10.18.7:3306/brave','techm2','techm2@@@','SELECT * FROM users');
DUMP STOCK_A;
