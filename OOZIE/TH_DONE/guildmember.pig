register 'pigjavamainv2.jar';
%declare ALIAS 'tieuhiep';
%declare ALIASGAME 'th';

STOCK_A = LOAD '$ALIAS.army$serverid' using org.apache.hive.hcatalog.pig.HCatLoader() AS (army_id,army_attr,army_member,army_building_attr:chararray);
STOCK_D = LOAD '$ALIAS.role_name_map$serverid' using org.apache.hive.hcatalog.pig.HCatLoader() AS (idrole_name_map,role_id,role_name,plat_user_name,ditch_name); 
STOCK_G = LOAD 'graph_mobo_vn.account_service_$gameid' using org.apache.hive.hcatalog.pig.HCatLoader(); 

--PROCESS army
STOCK_A1 = FOREACH STOCK_A GENERATE  $0,myudfs.JsonMap(myudfs.ToJson(myudfs.TestHex($1))) as army_attr,myudfs.LibMember(myudfs.LibMenTH(myudfs.TestHex($2))) as army_member,myudfs.TestHex($3) as army_building_attr, ToString(CurrentTime(),'yyyy-MM-dd HH:mm:ss') as date:chararray; 
STOCK_A2 = FOREACH STOCK_A1 GENERATE $0,$1,FLATTEN($2#'value'),$4; 
--DUMP STOCK_A2 ;

--PROCESS role_name_map
--STOCK_D1 = LIMIT STOCK_D 5; 
STOCK_D2 = FOREACH STOCK_D GENERATE $0 as idrole_name_map,$1 as role_id,myudfs.TestHex($2) as role_name,FLATTEN(STRSPLIT(myudfs.TestHex($3), '_')) as (a1:chararray, plat_user_name:chararray); 
--DUMP STOCK_D2;

STOCK_G1 = FOREACH STOCK_G GENERATE mobo_id,(chararray)$2 AS mobo_service_id,fullname ; 

--JOIN army_brief & role_name_map
STOCK_A_D = JOIN STOCK_A2 BY $2#'member_role_id' , STOCK_D2 BY role_id;
--DUMP STOCK_A_D;

STOCK_A_D_G = JOIN STOCK_A_D BY $8 , STOCK_G1 BY mobo_service_id;

--INFOMATION NEED
STOCK_FINAL = FOREACH STOCK_A_D_G GENERATE CONCAT((chararray)'$ALIASGAME',CONCAT('_',CONCAT((chararray)$serverid,CONCAT('_',(chararray)$0)))) as game_guild_id,$3 as date,myudfs.TimestamptoDate($2#'join_time') as join_date,$8 as msi_mem,$8 as accid_mem,$9 as mobo_id,(chararray)$11 as fullname,(chararray)$2#'member_role_id' as role_id_mem,0 as statussend;

STORE STOCK_FINAL INTO 'bigdata.guild_member' USING org.apache.hive.hcatalog.pig.HCatStorer();