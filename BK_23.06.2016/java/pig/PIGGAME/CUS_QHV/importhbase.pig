register '/home/java/filejar/pigjavamainv2.jar';
%declare ALIAS 'qhv';

STOCK_A = LOAD '$ALIAS.player$serverid' using org.apache.hive.hcatalog.pig.HCatLoader() ;
STOCK_B = LOAD '$ALIAS.gang$serverid' using org.apache.hive.hcatalog.pig.HCatLoader() ;


STOCK_A1 = FILTER STOCK_A BY $2 IS NOT NULL;
STOCK_A2 = FOREACH STOCK_A1 GENERATE $0 as id,$1 as userid,FLATTEN(STRSPLIT($2, '_')) as (a1:chararray, msi:chararray),$4 as name,$5 as lv,$6 as createdate,$7 as logindate,
ToString(CurrentTime(),'yyyy-MM-dd HH:mm:ss') as date:chararray ;

STOCK_B1 = FOREACH STOCK_B GENERATE id,FLATTEN(myudfs.ParseprotoQHVGuildMember(protodata)#'value') as proto;

STOCK_A_B = JOIN STOCK_A2 BY $0, STOCK_B1 BY $1#'roleid';


STOCK_A_B_G = FOREACH STOCK_B GENERATE id,myudfs.ParseprotoQHV(protodata) as proto;



STOCK_F_DONE = JOIN STOCK_A_B BY $0 LEFT OUTER, STOCK_A_B_G BY $1#'roleid';

STOCK_FINAL = FOREACH STOCK_F_DONE GENERATE $0 as key,$3 as accid_mem,$8 as date,$8 as date_modify,
myudfs.UnixtimetoDate( ( ($11 IS NULL)?$10#'joindate':$12#'guildcreatedate')  ) as game_guild_create_date,
CONCAT((chararray)'$ALIAS',CONCAT('_',CONCAT((chararray)$serverid,CONCAT('_',(chararray)$9)))) as game_guild_id,
CONCAT((chararray)'$ALIAS',CONCAT('_',CONCAT((chararray)$serverid,CONCAT('_',(chararray)$10#'guildname')))) as game_guild_name,$gameid as game_id,
(chararray)( ($11 IS NULL)?'':$4) as leadername,(chararray)myudfs.UnixtimetoDate($10#'joindate') as join_date,$3 as msi_mem,(chararray)$0 as role_id_mem,(chararray)$4 as role_name,$serverid as server_id;

STORE STOCK_FINAL INTO 'hbase://bigdata_qhv_temp' USING org.apache.pig.backend.hadoop.hbase.HBaseStorage('info:accid_mem,info:date,info:date_modify,info:game_guild_create_date,info:game_guild_id,info:game_guild_name,info:game_id,info:leadername,info:join_date,info:msi_mem,info:role_id_mem,info:role_name,info:server_id');

