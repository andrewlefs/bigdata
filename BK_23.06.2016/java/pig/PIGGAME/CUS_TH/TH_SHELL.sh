#!/bin/bash
GID=130
#TH=$(curl 'http://gapi.mobo.vn/?control=game&func=get_server_list&service_name=130&source=bigdata&is_sandbox=1')
TH=27
for SID in $TH
do
	echo "GameID:"$GID - "ServerID:"$SID
	echo "=======================STARTPIG============================="
	
	pig -param serverid=$SID  -param gameid=$GID -useHCatalog -f  '/home/java/pig/PIGGAME/CUS_TH/importhbase.pig'
	
	echo "======================ENDPIG==============================="

done

pig -param serverid=$SID  -param gameid=$GID -useHCatalog -f  '/home/java/pig/PIGGAME/CUS_TH/processfinal.pig'
#echo "truncate 'bigdata_temp'" | hbase shell 