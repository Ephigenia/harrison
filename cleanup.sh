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
rm -f tmp/cache/views/*
rm -f tmp/log/*
find . -not -name "*svn*" -name "p_*" -exec rm -f {} \;
echo 'done'

echo -ne 'chmodding files and directories ...'
chmod -R 777 tmp html/static
echo 'done'

echo -ne 'chmodding zip and deploy jobs ...'
find . -name "*.sh" -exec chmod +x {} \;
echo 'done'