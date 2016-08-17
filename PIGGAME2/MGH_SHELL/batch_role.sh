GID=106
declare -a serverlist=("1" "11" "21" "33" "47" "59" "68" "80" "85" "90" "91" "92" "93" "94" "95" "96" "97" "98" "99")

for SID in "${serverlist[@]}"
    do
        echo "GameID:"$GID - "ServerID:"$SID
        echo "==================================================================="
		pig -param serverid=$SID -param gameid=$GID -param filename=$SID -useHCatalog -f /home/java/pig/PIGGAME/MGH_SHELL/role.pig
    done