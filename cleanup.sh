#!/bin/bash
##############################################################################
# This will cleanup a nms.update project
#	- setting allmost all directories that should be writeable to 777
#	- remove cached models, css and js files and old logs
#
# Author: Marcel Eichner // Ephigenia <love@ephigenia.de>
# Date: 2009-07-18
##############################################################################

echo -ne 'cleaning cache directories and files ...'
rm -f tmp/log/*
rm -f tmp/model/*.json
rm -f tmp/cache/*
rm -f tmp/log/*

echo -ne 'deleting cached and packed css and js files ...'
find . -name "p_*.css" -exec rm -f {} \;
find . -name "p_*.js" -exec rm -f {} \;

echo -ne 'chmodding some files and directories ...'
chmod -R 777 tmp html/static
chmod -R 777 tmp tmp/
echo 'done'