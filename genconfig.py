#!/usr/bin/python
#
# configuration for the APRS log app
#

#
#-------------------------------------
# Setting values from config.ini file
#-------------------------------------
#
import socket
import os
import datetime
from configparser import ConfigParser
datafile = open("config.php", "w")
configdir=os.getenv('CONFIGDIR')
if configdir == None:
	configdir='/etc/local/'
configfile=configdir+'APRSconfig.ini'
hostname=socket.gethostname()
cfg=ConfigParser()
cfg.read(configfile)

DBpath                  = cfg.get('server', 'DBpath').strip("'").strip('"')
MySQLtext               = cfg.get('server', 'MySQL').strip("'").strip('"')
DBhost                  = cfg.get('server', 'DBhost').strip("'").strip('"')
DBuser                  = cfg.get('server', 'DBuser').strip("'").strip('"')
DBpasswd                = cfg.get('server', 'DBpasswd').strip("'").strip('"')
APPuser                 = cfg.get('server', 'APPuser').strip("'").strip('"')
APPpasswd               = cfg.get('server', 'APPpasswd').strip("'").strip('"')
DBname                  = cfg.get('server', 'DBname').strip("'").strip('"')
OGNDB                   = cfg.get('server', 'OGNDB').strip("'").strip('"')
AppUrl                  = cfg.get('server', 'AppUrl').strip("'").strip('"')
AppPort                 = cfg.get('server', 'AppPort').strip("'").strip('"')
#AppArea                 = cfg.get('server', 'AppArea').strip("'").strip('"')
AppNeLat                = cfg.get('server', 'AppNeLat')
AppNeLon                = cfg.get('server', 'AppNeLon')
AppSwLat                = cfg.get('server', 'AppSwLat')
AppSwLon                = cfg.get('server', 'AppSwLon')
AppZoom                 = cfg.get('server', 'AppZoom')
AppLat                  = cfg.get('server', 'AppLat').strip("'").strip('"')
AppLon                  = cfg.get('server', 'AppLon').strip("'").strip('"')
AppBase                 = cfg.get('server', 'AppBase').strip("'").strip('"')


datafile.write("<?php \n")
datafile.write("# SGP app configuration file \n")
datafile.write("# App hostname: "+hostname+"\n")
datafile.write("# App configdir: "+configdir+"\n")
datafile.write("# Config generated: "+datetime.datetime.now().strftime("%Y-%m-%d %H:%M:%S")+" \n")
datafile.write("$DBpath='"+DBpath+"'; \n")
datafile.write("$DBuser='"+DBuser+"'; \n")
datafile.write("$DBpasswd='"+DBpasswd+"'; \n")
datafile.write("$servername='"+DBhost+"'; \n")
datafile.write("$username='"+APPuser+"'; \n")
datafile.write("$password='"+APPpasswd+"'; \n")
datafile.write("$dbname='"+DBname+"'; \n")
datafile.write("$OGNDB='"+OGNDB+"'; \n")
datafile.write("$MySQL="+MySQLtext+"; \n")
datafile.write("$appurl='"+AppUrl+"'; \n")
datafile.write("$AppUrl='http://"+AppUrl+"'; \n")
datafile.write("$AppPort='"+AppPort+"'; \n")
#datafile.write("$AppArea='"+AppArea+"'; \n")
datafile.write("$AppLat="+AppLat+"; \n")
datafile.write("$AppLon="+AppLon+"; \n")
datafile.write("?> \n")
datafile.close()
# --------------------------------------#
datafile = open("config.json", "w")
datafile.write("{ 					    \n")
datafile.write('        "doc1"  :  "SGP app config file",   \n')
datafile.write('        "doc2"  :  "'+hostname+'",	    \n')
datafile.write('        "doc3"  :  "'+configdir+'",	    \n')
datafile.write('        "doc4"  :  "'+datetime.datetime.now().strftime("%Y-%m-%d %H:%M:%S")+'", \n')
datafile.write('	"center":{	 		    \n')
datafile.write('		"zoom":'+AppZoom	+', \n')
datafile.write('		"lat": '+AppLat 	+', \n')
datafile.write('		"lon": '+AppLon 	+', \n')
datafile.write('		"base":"'+AppBase	+'" \n')
datafile.write('	         },  		            \n')
datafile.write('	"socket":{	 		    \n')
datafile.write('		"server":"'+AppUrl	+'",\n')
datafile.write('		"port":  '+AppPort 	+'  \n')
datafile.write('	         },  		            \n')
datafile.write('	"bounds":{	 		    \n')
datafile.write('		"ne_lat":'+AppNeLat	+', \n')
datafile.write('		"ne_lon":'+AppNeLon	+', \n')
datafile.write('		"sw_lat":'+AppSwLat	+', \n')
datafile.write('		"sw_lon":'+AppSwLon 	+'  \n')
datafile.write('	         }  		            \n')
datafile.write('}  		         		    \n')
datafile.close()
# --------------------------------------#
