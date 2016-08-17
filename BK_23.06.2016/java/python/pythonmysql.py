#!/usr/bin/python
import MySQLdb

USERTH = "mapreduce"
PASSTH = "0XfAWJwiwb"
IPTH = "10.10.32.2"
DB = "gapi_mobo_vn"

db = MySQLdb.connect(host=IPTH,
                     user=USERTH, 
                     passwd=PASSTH, 
                     db=DB ) 
cur = db.cursor()

cur.execute("SELECT VERSION()")
data = cur.fetchone()   
print "Database version : %s " % data    
# Use all the SQL you like
cur.execute("SELECT DISTINCT server_id_merge FROM gapi_mobo_vn.server_list WHERE game = '130'AND create_date < now()AND status = 1 AND server_id < 5  ORDER BY server_id_merge")

# print all the first cell of all the rows
for row in cur.fetchall():
    print row[0]

db.close()
