#!/bin/bash
##############################################################################
# This is a bash shell script that can deploy a project to a remote host
# using ssh and rsync protocoll
#
# Author: Marcel Eichner // Ephigenia <love@ephigenia.de>
# Date: 2009-05-08
##############################################################################

# configuration
name="harrison"
host="marceleichner.de"
target="webseiten/code.marceleichner.de/html/projects/harrison/demo/"
source="./"
options="avzcu"

# welcome screen
echo "-----------------------------------------------------------------------"
if `figlet test >/dev/null 2>/dev/null`
	then figlet $name
	else echo $name
fi
echo "-----------------------------------------------------------------------"
echo "This will deploy $source to $host:$target"

# get user confirmation
read -n 1 -t 2 -p 'continue? (y/n)' confirmation
if [ "$confirmation" != y ] || [ -z $confirmation ]
	then echo " okay, stopping ..."; exit;
	else echo " okay, starting ..."
fi

# simulate ?
if [ -n "$1" ]
	then options="${options}n"
	else echo "!!! LIVE-ACTION MODE - FILES WILL BE MODIFIED, press CTRL+C to stop !!!"
fi

# set wait status
if [ -n "$1" ] & [ -a html/maintenance.php ] 
	then
		echo -n "setting maintenance mode ..."
		cat html/maintenance.php | ssh $host cat ">" $target/html/maintenance.php
		ssh $host "cd ${target}/html; cp index.php index.tmp.php; cp maintenance.php index.php;"
		echo " done"
fi

# exclude files if exlude.lst exists
if [ -f .gitignore ]
	then exclude="--exclude-from .gitignore"
	else exclude=""
fi

# -v fortschrittsanzeige
# -c check checksum
# -u update, neue dateien nicht überschreiben
# -n simulation
# --delete delete files that are deleted locally
# --modify-window=N toleranz für timestamp modified
rsync -$options --cvs-exclude --progress --exclude ".htaccess" --exclude ".gitmodules" $exclude $source -e ssh $host:$target 

# unset maintenance website
if [ -n "$1" ] & [ -a html/maintenance.php ]
	then
		echo -n "un-setting maintenance mode ..."
		cat html/index.php | ssh $host cat ">" $target/html/index.php
		echo " done"
fi