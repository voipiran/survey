#!/bin/bash
echo "Install voipiran Voiz Syrvey"
echo "VOIPIRAN.io"
echo "VOIPIRAN Voiz Survey Version 1.5"
sleep 1


echo "------------START-----------------"
echo "Install sourceguardian Files"
echo "------------Copy SourceGaurd-----------------"
yes | cp -rf sourceguardian/ixed.5.4.lin /usr/lib64/php/modules
yes | cp -rf sourceguardian/ixed.5.4ts.lin /usr/lib64/php/modules
yes | cp -rf /etc/php.ini /etc/php-old.ini
yes | cp -rf sourceguardian/php.ini /etc
echo "SourceGuardian Files have Moved Sucsessfully"
sleep 1

echo "Install viservey Mysql DataBase"
echo "------------Create DB-----------------"
#echo -n "Enter the MySQL root password: "
#read rootpw

###Fetch DB root PASSWORD
rootpw=$(sed -ne 's/.*mysqlrootpwd=//gp' /etc/issabel.conf)

mysql -uroot -p$rootpw -e "CREATE DATABASE IF NOT EXISTS visurvey DEFAULT CHARACTER SET utf8 COLLATE utf8_persian_ci;"
mysql -uroot -p$rootpw -e "GRANT ALL PRIVILEGES ON visurvey.* TO 'root'@'localhost';"

#mysql -uroot -p$rootpw visurvey < visurvey.sql
echo "DataBase Created Sucsessfully"
sleep 1

echo "------------Delete OLD Folders-----------------"
rm -rf /var/www/html/survey

echo "------------Create MiscDest-----------------"
query="REPLACE INTO miscdests (id,description,destdial) VALUES('100','Survey','4455')"
mysql -hlocalhost -uroot -p$rootpw asterisk -e "$query"
echo "-----------------------------"

echo "Copy Survey Folder and Set Permissions"
echo "------------Copy Files-----------------"
yes | cp -avr survey/ /var/www/html/ > /dev/null
chmod -R 777 /var/www/html/survey
chmod -R 777 /var/www/html/survey/uploads
chmod -R 777 /var/www/html/survey/core/config
chmod -R 777 /var/www/html/survey/app
echo "Web Files have Moved Sucsessfully"
sleep 1

echo "Make Link to Asterisk Folder"
echo "-------------Link Folder----------------"
ln -s /etc/asterisk /var/www/html/survey/asterisk
ln -s /var/spool/asterisk/monitor  /var/www/html/survey/core/survey/customerVoices

echo "Copy survey.php and Set Permissions"
echo "-------------Copy Files----------------"
yes | cp -rf visurvey.php /var/lib/asterisk/agi-bin
chmod 777 /var/lib/asterisk/agi-bin/visurvey.php
chown asterisk:asterisk /var/lib/asterisk/agi-bin/visurvey.php

yes | cp -rf viplayagentinfo.php /var/lib/asterisk/agi-bin
chmod 777 /var/lib/asterisk/agi-bin/viplayagentinfo.php
chown asterisk:asterisk /var/lib/asterisk/agi-bin/viplayagentinfo.php

yes | cp -rf visurvey.ini /var/lib/asterisk/agi-bin
chmod 777 /var/lib/asterisk/agi-bin/visurvey.ini
chown asterisk:asterisk /var/lib/asterisk/agi-bin/visurvey.ini

yes | cp -rf -rf say.conf /etc/asterisk
chmod 777 /etc/asterisk/say.conf
chown asterisk:asterisk /etc/asterisk/say.conf

yes | cp -rf -avr pr/ /var/lib/asterisk/sounds > /dev/null
chmod -R 777 /var/lib/asterisk/sounds/pr
chown -R asterisk:asterisk /var/lib/asterisk/sounds/pr


echo "Asterisk Files have Moved Sucsessfully"
sleep 1

echo "-------------Create ini File----------------"
echo dbuser = \"root\" >> /var/lib/asterisk/agi-bin/visurvey.ini
echo dbpass = \"$rootpw\" >> /var/lib/asterisk/agi-bin/visurvey.ini
echo dbaddress = \"localhost\" >> /var/lib/asterisk/agi-bin/visurvey.ini
echo dbname = \"visurvey\" >> /var/lib/asterisk/agi-bin/visurvey.ini
echo agentRole = \"karshenas\" >> /var/lib/asterisk/agi-bin/visurvey.ini
echo \#agentRole = \"operator\" >> /var/lib/asterisk/agi-bin/visurvey.ini
echo \#befarmaiidEnable = \"befarmaiid\" >> /var/lib/asterisk/agi-bin/visurvey.ini

echo "ini Files have Created Sucsessfully"
sleep 1

echo "Add dialplan code to extensions_custom.conf"
echo "-------------Extension Custom----------------"
sed -i '/\[from\-internal\-custom\]/a include \=\> voipiran\-survey' /etc/asterisk/extensions_custom.conf
echo "" >> /etc/asterisk/extensions_custom.conf
echo "[voipiran-survey]" >> /etc/asterisk/extensions_custom.conf
echo "exten => 4455,1,AGI(visurvey.php)" >> /etc/asterisk/extensions_custom.conf
echo "Dialplans have Set Sucsessfully"
sleep 1

echo "Add QAGI Variable to globals_custom.conf"
echo "-------------Extension Custom----------------"
echo "" >> /etc/asterisk/globals_custom.conf
echo "QAGI=viplayagentinfo.php" >> /etc/asterisk/globals_custom.conf

echo "-------------Issabel Menu----------------"
issabel-menumerge menu.xml
echo "Issabel Menu is Created Sucsessfully"
sleep 1

#echo "-------------Installing Composer----------------"
#yum -y -q install php-cli php-zip wget unzip  > /dev/null
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php --install-dir=/usr/local/bin --filename=composer  > /dev/null

echo "-------------Apache Restart----------------"
service httpd restart
echo "Apache has Restarted Sucsessfully"
sleep 1

echo "-----------FINISHED (voipiran.io)-----------"

