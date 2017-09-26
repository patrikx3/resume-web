#!/usr/bin/env bash
REPO=~/Projects/patrikx3/resume/resume-web/deployment
BUILD=$REPO/build
find $REPO -type d -exec chmod 755 {} +
find $REPO -type f -exec chmod 644 {} +
chmod 0777 $REPO/version.txt

rm -rf $BUILD
mkdir -p $BUILD
chmod 0777 $BUILD


