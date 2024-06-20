#!/bin/bash
# install a new instance into a server
# must be executed with login root
git clone https://github.com/inrae/otolithe.git -b develop
cp env .env
chgrp -R www-data .
find . -type d -exec chmod 750 {} \;
find . -type f -exec chmod 640 {} \;
chmod -R g+w writable
