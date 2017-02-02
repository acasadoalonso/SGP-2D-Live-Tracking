#!/bin/bash

for f in *.csv
do
	mysql -e "use SWIFACE; load data local infile '"$f"' into table GEOMETRY fields TERMINATED BY ',' LINES TERMINATED BY '\n';"  -u root -pogn
done
