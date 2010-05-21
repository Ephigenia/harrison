#!/bin/bash
##############################################################################
# Create A Zip File From the current git repository
#
# Author: Marcel Eichner // Ephigenia <love@ephigenia.de>
# Date: 2009-06-08
##############################################################################

name="harrison_cms"
git archive --format=zip --prefix=trunc/ HEAD > "${name}_"`date "+%Y-%m-%d".zip`