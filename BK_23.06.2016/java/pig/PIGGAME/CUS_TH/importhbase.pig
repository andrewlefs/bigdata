register '/home/java/filejar/pigjavamainv2.jar';
%declare ALIAS 'tieuhiep';
%declare ALIASGAME 'th';

STOCK_A = LOAD '$ALIAS.army$serverid' using org.apache.hive.hcatalog.pig.HCatLoader() AS (army_id,army_attr,army_member,army_building_attr:chararray);
STOCK_B = LOAD '$ALIAS.army_brief$serverid' using org.apache.hive.hcatalog.pig.HCatLoader(); 
STOCK_D = LOAD '$ALIAS.role_name_map$serverid' using org.apache.hive.hcatalog.pig.HCatLoader() AS (idrole_name_map,role_id,role_name,plat_user_name,ditch_name); 

--PROCESS army
STOCK_A1 = FOREACH STOCK_A GENERATE  $0,myudfs.JsonMap(myudfs.ToJson(myudfs.TestHex($1))) as army_attr,myudfs.LibMember(myudfs.LibMenTH(myudfs.TestHex($2))) as army_member,myudfs.TestHex($3) as army_building_attr, ToString(CurrentTime(),'yyyy-MM-dd HH:mm:ss') as date:chararray; 
--STOCK_A2 = FOREACH STOCK_A1 GENERATE $0,army_attr#'create_time' as create_time,FLATTEN($2#'value'),$4; 
STOCK_A2 = FOREACH STOCK_A1 GENERATE $0,$1,FLATTEN($2#'value'),$4; 

--PROCESS army_brief
--STOCK_B2 = FOREACH STOCK_B GENERATE $0 as idarmy_brief,$1 as army_id,myudfs.TestHex($2) as army_name,$3 as army_level,$8 as leader_id,myudfs.TestHex($9) as leader_name ; 
STOCK_B2 = FOREACH STOCK_B GENERATE myudfs.TestHex($2) as army_name,$3 as army_level,$8 as leader_id,myudfs.TestHex($9) as leader_name ; 

STOCK_D2 = FOREACH STOCK_D GENERATE $0 as idrole_name_map,$1 as role_id,myudfs.TestHex($2) as role_name,FLATTEN(STRSPLIT(myudfs.TestHex($3), '_')) as (a1:chararray, plat_user_name:chararray); 

STOCK_A_D = JOIN STOCK_A2 BY $2#'member_role_id', STOCK_D2 BY role_id;

STOCKTEST = FOREACH STOCK_A2 GENERATE $2#'member_role_id',myudfs.TimestamptoDate($2#'join_time') as join_date;

STOCK_A_D_B = JOIN STOCK_A_D BY $2#'member_role_id' LEFT OUTER, STOCK_B2 BY $2;

STOCK_FINAL = FOREACH STOCK_A_D_B GENERATE (chararray)$2#'member_role_id' as key,
$8 as accid_mem,$3 as date,$3 as date_modify,
(chararray)myudfs.TimestamptoDate($1#'create_time') as game_guild_create_date,
CONCAT((chararray)'$ALIASGAME',CONCAT('_',CONCAT((chararray)$serverid,CONCAT('_',(chararray)$0)))) as game_guild_id,
CONCAT((chararray)'$ALIASGAME',CONCAT('_',CONCAT((chararray)$serverid,CONCAT('_',(chararray)$1#'army_name')))) as game_guild_name,
$gameid as game_id,$12 as leadername,
(chararray)myudfs.TimestamptoDate($2#'join_time') as join_date,
$8 as msi_mem,(chararray)$2#'member_role_id' as role_id_mem,(chararray)$2#'member_name' as role_name,
$serverid as server_id;



STORE STOCK_FINAL INTO 'hbase://bigdata_temp' USING org.apache.pig.backend.hadoop.hbase.HBaseStorage('info:accid_mem,info:date,info:date_modify,info:game_guild_create_date,info:game_guild_id,info:game_guild_name,info:game_id,info:leadername,info:join_date,info:msi_mem,info:role_id_mem,info:role_name,info:server_id');


/*
—Load from HBase
C = load ‘hbase://test-table’
   using org.apache.pig.backend.hadoop.hbase.HBaseStorage(‘cf1, cf2’, ‘-loadKey true‘)
   as (rowkey:bytearray, cf1:map[], cf2:map[]);
   
— Store in HBase
store F into ‘hbase://test-table’
   using org.apache.pig.backend.hadoop.hbase.HBaseStorage(‘cf1’);   
*/

