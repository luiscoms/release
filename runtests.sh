#!/bin/bash

BIN_DOCKER=$(which docker)

if [ $? != 0 ]; then
    echo "Unable to find docker"
    exit 1
fi

docker run -it -v ${PWD}:/release luiscoms/release chmod 444 tests/fixtures/invalid/perms/*/composer.json
docker run -it -v ${PWD}:/release -u `stat . -c "%u:%g"` luiscoms/release phpunit -vc tests/
