###Update Survey VOIPIRAN
#!/bin/bash
echo "Install voipiran Voiz Syrvey"
echo "VOIPIRAN.io"
echo "VOIPIRAN Voiz Survey Version 1.4"
sleep 1

###Fetch DB root PASSWORD
rootpw=$(sed -ne 's/.*mysqlrootpwd=//gp' /etc/issabel.conf)

mysqldump -u root -p$rootpw visurvey survey > visurvey-survey-bk.sql

rm -rf /var/www/html/survey

chmod 777 install.sh 
./install.sh

mysqldump -u root -p$rootpw visurvey survey < visurvey-survey-bk.sql

echo "-----------FINISHED (voipiran.io)-----------"

