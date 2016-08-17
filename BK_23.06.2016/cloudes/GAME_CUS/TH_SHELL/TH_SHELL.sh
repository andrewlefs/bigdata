#!/bin/bash
GID=130
TH=$(curl 'http://gapi.mobo.vn/?control=game&func=get_server_list&service_name=130&source=bigdata&is_sandbox=1')

for SID in $TH
do
	echo "GameID:"$GID - "ServerID:"$SID
	echo "=======================STARTPIG============================="
	
	pig -param serverid=$SID  -param gameid=$GID -useHCatalog -f  'hdfs://hadoop.core:8020/user/yarn/GAME_CUS/TH_CUS/importhbase.pig'
	
	echo "======================ENDPIG==============================="

done

pig -param serverid=$SID  -param gameid=$GID -useHCatalog -f  'hdfs://hadoop.core:8020/user/yarn/GAME_CUS/TH_CUS/processfinal.pig'
hive -e "truncate table bigdata.bigdata_th_temp"
#echo "truncate 'bigdata_th_temp'" | hbase shell 