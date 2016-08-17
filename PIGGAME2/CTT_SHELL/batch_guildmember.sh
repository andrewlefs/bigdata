GID=133
declare -a serverlist=("1" "2" "3" "4" "5" "6" "7" "8" "9" "10" "11" "12" "13" "14" "15" "16")

for SID in "${serverlist[@]}"
    do
        echo "GameID:"$GID - "ServerID:"$SID
        echo "==================================================================="
		pig -param serverid=$SID -param gameid=$GID -param filename=$SID -useHCatalog -f /home/java/pig/PIGGAME/CTT_SHELL/guildmember.pig
    done