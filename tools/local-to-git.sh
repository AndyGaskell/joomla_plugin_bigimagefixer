#!/bin/bash

LOCALPATH='/var/www/html/bigimagefixertest'


cp $LOCALPATH/plugins/content/bigimagefixer/bigimagefixer.xml ../src/ -v
cp $LOCALPATH/plugins/content/bigimagefixer/bigimagefixer.php ../src/ -v
cp $LOCALPATH/administrator/language/en-GB/en-GB.plg_content_bigimagefixer.ini ../src/ -v
cp $LOCALPATH/administrator/language/en-GB/en-GB.plg_content_bigimagefixer.sys.ini ../src/ -v
