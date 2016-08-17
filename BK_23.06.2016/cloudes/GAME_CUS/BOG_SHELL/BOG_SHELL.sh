#!/bin/bash
GID=108
BOG=$(curl 'http://gapi.mobo.vn/?control=game&func=get_server_list&service_name=bog&source=bigdata&is_sandbox=1')
for SIDS in $BOG
do
       SID=$((10#${SIDS:3}))
	echo "GameID:"$GID - "ServerID:"$SID
	echo "=======================STARTPIG============================="
	
	pig -param serverid=$SID  -param gameid=$GID -useHCatalog -f  'hdfs://hadoop.core:8020/user/yarn/GAME_CUS/BOG_CUS/importhbase.pig'
	
	echo "======================ENDPIG==============================="

done

pig -param serverid=$SID  -param gameid=$GID -useHCatalog -f  'hdfs://hadoop.core:8020/user/yarn/GAME_CUS/BOG_CUS/processfinal.pig'
hive -e "truncate table bigdata.bigdata_bog_temp"
#echo "truncate 'bigdata_bog_temp'" | hbase shell