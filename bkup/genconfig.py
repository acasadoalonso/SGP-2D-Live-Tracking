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

hostname=socket.gethostname()
cfg=ConfigParser()
cfg.read('/etc/local/APRSconfig.ini')

DBpath                  = cfg.get('server', 'DBpath').strip("'").strip('"')
MySQLtext               = cfg.get('server', 'MySQL').strip("'").strip('"')
DBhost                  = cfg.get('server', 'DBhost').strip("'").strip('"')
DBuser                  = cfg.get('server', 'DBuser').strip("'").strip('"')
DBpasswd                = cfg.get('server', 'DBpasswd').strip("'").strip('"')
APPuser                 = cfg.get('server', 'APPuser').strip("'").strip('"')
APPpasswd               = cfg.get('server', 'APPpasswd').strip("'").strip('"')
DBname                  = cfg.get('server', 'DBname').strip("'").strip('"')
AppUrl                  = cfg.get('server', 'AppUrl').strip("'").strip('"')
AppPort                 = cfg.get('server', 'AppPort').strip("'").strip('"')
AppArea                 = cfg.get('server', 'AppArea').strip("'").strip('"')


datafile.write("<?php \n")
datafile.write("# SGP app configuration file \n")
datafile.write("# App hostname: "+hostname+"\n")
datafile.write("# Config generated: "+datetime.datetime.now().strftime("%Y-%m-%d %H:%M:%S")+" \n")
datafile.write("$DBpath='"+DBpath+"'; \n")
datafile.write("$DBuser='"+DBuser+"'; \n")
datafile.write("$DBpasswd='"+DBpasswd+"'; \n")
datafile.write("$servername='"+DBhost+"'; \n")
datafile.write("$username='"+APPuser+"'; \n")
datafile.write("$password='"+APPpasswd+"'; \n")
datafile.write("$dbname='"+DBname+"'; \n")
datafile.write("$MySQL="+MySQLtext+"; \n")
datafile.write("$appurl='"+AppUrl+"'; \n")
datafile.write("$AppUrl='"+AppUrl+"'; \n")
datafile.write("$AppPort='"+AppPort+"'; \n")
datafile.write("$AppArea='"+AppArea+"'; \n")
datafile.write("?> \n")
# --------------------------------------#
datafile.close()
