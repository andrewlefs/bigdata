--register '/home/java/filejar/protobuf-java-2.6.1.jar';
register '/user/yarn/GAME/LIBGAME/pigjavamainv2.jar';

%declare ALIAS 'qhv';
STOCK_A = LOAD '$ALIAS.player$serverid' using org.apache.hive.hcatalog.pig.HCatLoader() ;
STOCK_G = LOAD 'graph_mobo_vn.account_service_$gameid' using org.apache.hive.hcatalog.pig.HCatLoader(); 
--START PROCCESS

STOCK_A1 = FILTER STOCK_A BY $2 IS NOT NULL;
STOCK_A2 = FOREACH STOCK_A1 GENERATE $0 as id,$1 as userid,FLATTEN(STRSPLIT($2, '_')) as (a1:chararray, msi:chararray),
$4 as name,$5 as lv,$6 as createdate,$7 as logindate,
ToString(CurrentTime(),'yyyy-MM-dd HH:mm:ss') as date:chararray ;

--PROCESS account

STOCK_G1 = GROUP STOCK_G BY (mobo_id,mobo_service_id,fullname);
STOCK_G2 = FOREACH STOCK_G1 GENERATE group.mobo_id,(chararray)group.mobo_service_id AS mobo_service_id,group.fullname as fullname ;


 
STOCK_A_G = JOIN STOCK_A2 BY $3, STOCK_G2 BY $1;
--INFOMATION NEED

STOCK_FINAL = FOREACH STOCK_A_G GENERATE (chararray)$8 as date,(chararray)$8 as date_modify,$gameid as game_id,
$serverid as server_id,(chararray)$10 as accid,(chararray)$10 as msi,$9 as mobo_id,(chararray)$11 as fullname,
(chararray)$0 as role_id,$4 as role_name,(chararray)$6 as create_role_date,(chararray)$7 as last_login_date,(int)$5 as level;


--STORE STOCK_FINAL INTO 'output/BOG/role$serverid';
STORE STOCK_FINAL INTO 'bigdata.role' USING org.apache.hive.hcatalog.pig.HCatStorer();

