#!/bin/sh

echo "Changing folder"
cd /var/www
echo "Pulling changes"
# Dont forget the -u the first time to remember remote and branch
git pull
echo "Checking out last version"
git checkout .