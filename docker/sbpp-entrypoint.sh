#!/bin/bash

set -xe

mv -vn /opt/docker/sbpp/* /app

# Ensure permissions
chown -R application:application /app
chmod -R 644 /app/demos
chmod -R 774 /app/themes_c
chmod -R 644 /app/images/maps
chmod -R 644 /app/images/games

# If SBPP_INSTALL is set to true then remove `/install`
if [ "false" == "$SBPP_INSTALL" ]; then
    chmod 644 /app/config.php
    rm -rf /app/install/
fi

# If SBPP_UPDATE is set to true then remove `/update`
if [ "false" == "$SBPP_UPDATE" ]; then
    chmod 644 /app/config.php
    rm -rf /app/update/
fi