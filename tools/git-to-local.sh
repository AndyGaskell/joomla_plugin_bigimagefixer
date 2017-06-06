#!/bin/bash

LOCALPATH='/var/www/html/bigimagefixertest'

mkdir $LOCALPATH/plugins/content/bigimagefixer/
cp ../src/bigimagefixer.xml  $LOCALPATH/plugins/content/bigimagefixer/ -v
cp ../src/bigimagefixer.php  $LOCALPATH/plugins/content/bigimagefixer/ -v
cp ../src/en-GB.plg_content_bigimagefixer.ini  $LOCALPATH/administrator/language/en-GB/ -v
cp ../src/en-GB.plg_content_bigimagefixer.sys.ini $LOCALPATH/administrator/language/en-GB/ -v

