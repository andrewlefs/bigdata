GID=130
declare -a serverlist=("28")

for SID in "${serverlist[@]}"
    do
        echo "GameID:"$GID - "ServerID:"$SID
        echo "==================================================================="
		pig -param serverid=$SID -param gameid=$GID -param filename=$SID -useHCatalog -f /home/java/pig/PIGGAME/TH_SHELL/guildmember.pig
    done