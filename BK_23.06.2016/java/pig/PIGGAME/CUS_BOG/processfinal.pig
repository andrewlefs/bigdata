STOCK_F = LOAD 'hbase://bigdata_bog_temp' using org.apache.pig.backend.hadoop.hbase.HBaseStorage('info', '-loadKey true');
   
STOCK_G = LOAD 'graph_mobo_vn.account_service_$gameid' using org.apache.hive.hcatalog.pig.HCatLoader();    

STOCK_G0 = GROUP STOCK_G BY (mobo_id,mobo_service_id,fullname);
STOCK_G1_1 = FILTER STOCK_G0 BY group.$0 IS NOT NULL And group.$1 IS NOT NULL;
STOCK_G2 = FOREACH STOCK_G1_1 GENERATE group.$0 as mobo_id,(chararray)group.$1 AS mobo_service_id,group.$2 as fullname;

STOCK_FINAL = JOIN STOCK_F BY $1#'msi_mem', STOCK_G2 BY mobo_service_id;


STOCK_FINAL_LAST = FOREACH STOCK_FINAL GENERATE (chararray)$1#'date' as date,(chararray)$1#'date_modify' as date_modify,(int)$1#'game_id' as game_id,
(int)$1#'server_id' as server_id,(chararray)$1#'game_guild_id' as game_guild_id,(chararray)$1#'game_guild_name' as game_guild_name,(chararray)$1#'game_guild_create_date' as game_guild_create_date,
(chararray)$1#'role_id_mem' as role_id,(chararray)$1#'role_name' as role_name,(chararray)$1#'leadername' as leader_name,(chararray)$1#'join_date' as join_date,(chararray)$1#'msi_mem' as mobo_service_id,(chararray)$1#'accid_mem' as accid_mem,(chararray)$2 as mobo_id,(chararray)$4 as fullname;

STORE STOCK_FINAL_LAST INTO 'bigdata.guildall' USING org.apache.hive.hcatalog.pig.HCatStorer();