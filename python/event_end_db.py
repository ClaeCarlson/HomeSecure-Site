#!/var/www/html/python
#Bryce Renninger 04/20/18
#Connects to database and inserts a row into the log table when it is called upon. 
#It is called upon when motion is done detecting motion, and inserts a 0 into the camera status.

import MySQLdb
import time
import sys

# Open database connection
db = MySQLdb.connect(user="homesecure",	passwd="aurora",db="homesecure" )

# prepare a cursor object using cursor() method
cursor = db.cursor()

sql = "SELECT status FROM system WHERE id = 1" 

try:
	cursor.execute(sql)
	row = list(cursor.fetchone())
	status = row[0]
	status1 = str(status)
	sql1 = "INSERT INTO logs (status, sensors_id, system_id) VALUES (0,1,1)"
	if status == 1: 
		try:
			cursor.execute(sql1)
			db.commit()
		except:
			db.rollback()
			print "ERROR INSERT"
	
except:
	print "Error"

cursor.close()
db.close()