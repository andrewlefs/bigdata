#!/bin/bash
GID=125
QHV=$(curl 'http://gapi.mobo.vn/?control=game&func=get_server_list&service_name=125&source=bigdata&is_sandbox=1')
#QHV=60001
for SIDS in $QHV
do
       SID=$((10#${SIDS:3}))
	echo "GameID:"$GID - "ServerID:"$SID
	echo "=======================STARTPIG============================="
	
	pig -param serverid=$SID  -param gameid=$GID -useHCatalog -f  'hdfs://hadoop.core:8020/user/yarn/GAME/QHV_SHELL/guild.pig' 
	pig -param serverid=$SID  -param gameid=$GID -useHCatalog -f  'hdfs://hadoop.core:8020/user/yarn/GAME/QHV_SHELL/guildmember.pig'  
	
	pig -param serverid=$SID  -param gameid=$GID -useHCatalog -f  'hdfs://hadoop.core:8020/user/yarn/GAME/QHV_SHELL/role.pig'
	pig -param serverid=$SID  -param gameid=$GID -useHCatalog -f  'hdfs://hadoop.core:8020/user/yarn/GAME/QHV_SHELL/account.pig'
	
	echo "======================ENDPIG==============================="

	
done