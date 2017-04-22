import csv
# Title,Code,Country,Latitude,Longitude,Elevation,Style,Direction,Length,Frequency,Description
with open('wp.txt', 'rb') as csvfile:
     reader = csv.reader(csvfile, delimiter=',', quotechar='"')
     first=True
     for row in reader:
         #print ': '.join(row)
	 if first:
		first=False
		continue
     	 title 		= row[0]
     	 code 		= row[1]
     	 country 	= row[2]
     	 lati 		= row[3]
	 latitude = float(lati[0:8])/100
	 if lati[8] =='S':
		latitude *= -1
     	 long		= row[4]
	 longitude= float(long[0:9])/100
	 if long[9] == 'W':
		longitude *= -1
     	 alti		= row[5]
     	 if alti[-1] == 'm':
		altitude =int(alti[0:-1])
     	 style 		= row[6]
	 print title, code, country, latitude, longitude, altitude, style
