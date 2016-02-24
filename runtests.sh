#!/bin/bash

BIN_DOCKER=$(which docker)

if [ $? != 0 ]; then
    echo "Unable to find docker"
    exit 1
fi

PJ_ROOT=$(pwd)

if ! [ -d vendor ]; then
    echo "Running composer install"
    docker run --rm -it -v ${PJ_ROOT}:/release -u `stat . -c "%u:%g"` luiscoms/release composer install
fi

docker run --rm -it -v ${PJ_ROOT}:/release luiscoms/release chmod 444 tests/fixtures/invalid/perms/*/composer.json
docker run --rm -it -v ${PJ_ROOT}:/release -u `stat . -c "%u:%g"` luiscoms/release phpunit --testdox -vc tests/

if [ -z $1 ];then
    exit;
fi

docker run --rm -it -v ${PJ_ROOT}:/release -u `stat . -c "%u:%g"` luiscoms/release bash -c 'cd tests; humbug'

if [ -z $2 ];then
    exit;
fi

docker run --rm -it \
            -e "COVERALLS_RUN_LOCALLY=1" \
            -e "COVERALLS_REPO_TOKEN="$COVERALLS_REPO_TOKEN \
            -v ${PJ_ROOT}:/release luiscoms/release \
            vendor/bin/coveralls -v
