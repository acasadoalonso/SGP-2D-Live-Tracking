#!/usr/bin/python
#
# Silent Wings interface --- JSON formaat
#
import json
import time
import sys
import os
import MySQLdb
import datetime
import urllib.parse
from  ognddbfuncs import *
import config

#
#   This script set the pairing between OGN trackers and flarms that are on the same glider, so it become a virtual single device
#

action='list'
trk='ALL'
tflarmid=''
towner=''
deleteyn='N'
#print (sys.argv)
if len(sys.argv) >1:
	arg1 = sys.argv[1]
	action = arg1[0:]				
if len(sys.argv) >2:
	arg2 = sys.argv[2]
	trk = arg2[0:9].upper()
#print (len(sys.argv), "Action=", action, "Tracker=", trk )

localtime = datetime.datetime.now()					# get today's date
today = localtime.strftime("%y/%m/%d %H:%M:%S")					# in string format yymmdd
DBpath   = config.DBpath							# use the configuration DB path
DBname   = config.DBname							# use the configuration DB name
DBname   ='APRSLOG'
DBtable  = 'TRKSTATUS'

html1 = """<head><meta charset="UTF-8"><meta http-equiv="refresh" content="30" > </head><TITLE>TRACKERs Status</TITLE> <IMG src="./img/ogn-logo-150x150.png" border=1 alt=[image]><H1>WGC2020 Trackers STATUS: </H1> <HR> <P>Today is:  %s and we have %d trackers on TRKDEVICES table.  <br /> <br /> <br /> </p> </HR> """
html2 = """<center><table><tr><td><pre>"""
html3 = """</pre></td></tr></table></center>"""
html4 = '<a href='+"UBUNTU"+'SWS/pairtrk.php?action=edit&trk=%s&flarmid=%s&owner=%s&active=%s'


#
conn = MySQLdb.connect(host=config.DBhost, user=config.DBuser, passwd=config.DBpasswd, db=DBname, connect_timeout=1000)     # connect with the database
curs = conn.cursor()				# connect with the DB set the cursor

#
# action LIST ALL pair
#
cmd1 = "select count(*) from TRKDEVICES where devicetype = 'OGNT' and active = 1;"
try:
        curs.execute(cmd1)
except MySQLdb.Error as e:
        print ("SQL error: ",e)
row = curs.fetchone()
nrecs=row[0]
cmd0="SELECT   count(*) FROM OGNTRKSTATUS ;"
cmd1="SELECT * FROM OGNTRKSTATUS where source = 'STAT' and id in (select id from TRKDEVICES where active = 1 and devicetype = 'OGNT') ORDER BY otime DESC;"
cmd2="SELECT * FROM OGNTRKSTATUS where source = 'STAT' and id = '"+trk+"' ORDER BY otime DESC;"
cmd3="SELECT * FROM OGNTRKSTATUS ORDER BY otime DESC;"
try:
        curs.execute(cmd0)
except MySQLdb.Error as e:
        print ("SQL error: ",e)
row=curs.fetchone()
print ("Number of records on TRKSTATUS:", row[0])
if trk == 'ALL':
        if action == 'full':
           cmd = cmd3
        else:
           cmd = cmd1
else:
	cmd = cmd2 
#print (cmd)
try:
        curs.execute(cmd)
except MySQLdb.Error as e:
        print ("SQL error: ",e)
trks={}
trkt={}
print (html1% (today,nrecs))
print (html2)
print ("<b> <a>TRKDEV  IDTRK     REGTRK CID STATION       UTCTIME            STATUS     r </a> </b> <br />") 
for row in curs.fetchall():                                    # search for the first 20 the rows
        # flarmid is the first field
        id1      = row[0]
        station  = row[1]
        otime    = row[2]
        status   = row[3]
        source   = row[4]
        reg=getognreg(id1[3:])
        cid=getogncn(id1[3:])
        sp=status[8:].find(' ')
        if sp == 20:
           continue
        if id1 not in trks:
           trks[id1] = 1
        else:
           trks[id1] += 1
        if status[6:8] == 'h ':
           qlf=id1+status[8:11]
        else:
           qlf=id1+status[0:3]
           if status[0] == 'h' and status[3:5] == ' v':
              status = "        "+status
        if qlf in trkt:
           continue
        else:
           trkt[qlf]=otime
        if action == 'list' and status[8] != 'h':
           continue 
        print ("<a> TRKDEV: %-9s %-7s %-3s %-9s %-20s %-30s %4s "% (id1, reg, cid, station, str(otime), status, source), "</a>")

print (html3)
conn.close()

exit(0)
