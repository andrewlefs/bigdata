GID=125
QHV=$(curl 'http://gapi.mobo.vn/?control=game&func=get_server_list&service_name=125&source=bigdata&is_sandbox=1')
for SIDS in $QHV     
do
       SID=$((10#${SIDS:3}))
	echo "GameID:"$GID - "ServerID:"$SID
	echo "=======================STARTPIG============================="
	
	pig -param serverid=$SID  -param gameid=$GID -useHCatalog -f  'hdfs://hadoop.core:8020/user/yarn/GAME_CUS/QHV_CUS/importhbase.pig'
	
	echo "======================ENDPIG==============================="

done

pig -param serverid=$SID  -param gameid=$GID -useHCatalog -f  'hdfs://hadoop.core:8020/user/yarn/GAME_CUS/QHV_CUS/processfinal.pig'
hive -e "truncate table bigdata.bigdata_qhv_temp"
#echo "truncate 'bigdata_qhv_temp'" | hbase shell 