#!/bin/bash

# Script for check master state of MongoDB by keepalived daemon

ISMASTER=`/usr/bin/mongosh -host 127.0.0.1 --quiet --eval "db.isMaster().ismaster"`
[ $ISMASTER == 'true' ] && exit 0 || exit 1
