#!/bin/bash

webdir=/var/www/weixiao001.com/
webuser=www
webgroup=www

#/usr/local/bin/git pull github master
rm -rf $webdir'*'
cp -R * $webdir
rm -f $webdir'README'
rm -f $webdir'wxsql20111106-shema.sql'
rm -f $webdir'deploy.sh'
chown -R $webuser $webdir
chgrp -R $webuser $webdir

echo ' -- deploy done! do not forget to modify application/config/config.php'
