GID=130
for (( SID=1; SID<=21 ; ++SID ))
    do
        echo "GameID:"$GID - "ServerID:"$SID
        echo "==================================================================="
		pig -param serverid=$SID -param gameid=$GID -param filename=$SID -useHCatalog -f /home/java/pig/PIGGAME/TH/guild.pig
    done