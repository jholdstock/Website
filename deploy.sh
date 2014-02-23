#!/bin/sh

echo "Changing folder"
cd /var/www
echo "Pulling changes"
git pull origin master
echo "Checking out last version"
git checkout .