#!/bin/bash
GID=133
CTT=$(curl 'http://gapi.mobo.vn/?control=game&func=get_server_list&service_name=133&source=bigdata&is_sandbox=1')

pig -param serverid=1  -param gameid=$GID -useHCatalog -f  'hdfs://hadoop.core:8020/user/yarn/GAME/CTT_SHELL/account.pig'
for SIDS in $CTT
do
        SID=$((10#${SIDS:3}))
	echo "GameID:"$GID - "ServerID:"$SID
	echo "=======================STARTPIG============================="
	
	pig -param serverid=$SID  -param gameid=$GID -useHCatalog -f  'hdfs://hadoop.core:8020/user/yarn/GAME/CTT_SHELL/guild.pig' 
	pig -param serverid=$SID  -param gameid=$GID -useHCatalog -f  'hdfs://hadoop.core:8020/user/yarn/GAME/CTT_SHELL/guildmember.pig'  
	
	pig -param serverid=$SID  -param gameid=$GID -useHCatalog -f  'hdfs://hadoop.core:8020/user/yarn/GAME/CTT_SHELL/role.pig'

	
	echo "======================ENDPIG==============================="

	
done
