STOCK_A = LOAD 'NYSE_daily_prices_A.csv' USING PigStorage(',') 
    AS (exchange:chararray, symbol:chararray, date:chararray,                 
    open:float, high:float, low:float, close:float, volume:int, adj_close:float); 
  
B = LIMIT STOCK_A 100; 
DESCRIBE B; 	
DUMP B;	