GID=133
for (( SID=1; SID<=7 ; ++SID ))
    do
        echo "GameID:"$GID - "ServerID:"$SID
        echo "==================================================================="
		pig -param serverid=$SID -param gameid=$GID -param filename=$SID -useHCatalog -f /home/java/pig/PIGGAME/CTT/guildmember.pig
    done