GID=108
declare -a serverlist=("1" "4" "7" "10" "13" "16" "19" "22" "25" "28" "31" "34" "37" "39" "41" "42" "43")

for SID in "${serverlist[@]}"
    do
        echo "GameID:"$GID - "ServerID:"$SID
        echo "==================================================================="
		pig -param serverid=$SID -param gameid=$GID -param filename=$SID -useHCatalog -f /user/yarn/oozie-oozi/game/bog/account.pig
	echo "=====================FINISH=========================="	
    done