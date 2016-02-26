#!/bin/bash

BIN_DOCKER=$(which docker)

if [ $? != 0 ]; then
    echo "Unable to find docker"
    exit 1
fi

PJ_ROOT=$(pwd)

tags=( php5.6 php7.0 )
for tag in "${tags[@]}"; do
    # build the image if not exists
    # docker build url#branch:directory
    # docker build -t luiscoms/release:$tag https://github.com/luiscoms/release.git#develop:$tag
    if [ -z $(docker images -q luiscoms/release:$tag) ]; then
        echo "Bulding image "$tag
        docker build -t luiscoms/release:$tag -f $tag/Dockerfile ${PJ_ROOT}
    fi
done

if ! [ -d vendor ]; then
    echo "Running composer install"
    docker run --rm -it -v ${PJ_ROOT}:/release -u `stat . -c "%u:%g"` luiscoms/release composer install
fi

# setting up permissions
chmod 444 tests/fixtures/invalid/perms/*/composer.json

# for each tag run the tests
for tag in "${tags[@]}"; do
    # build the image if not exists
    echo "Rinning tests on "$tag
    # docker run --rm -it -v ${PJ_ROOT}:/release -u `stat . -c "%u:%g"` luiscoms/release phpunit --testdox -vc tests/
    docker run --rm -it -v ${PJ_ROOT}:/release -u `stat . -c "%u:%g"` luiscoms/release:$tag phpunit -vc tests/
done

if ! [ -z $1 ];then
    docker run --rm -it -v ${PJ_ROOT}:/release -u `stat . -c "%u:%g"` luiscoms/release bash -c 'cd tests; humbug'
fi

if ! [ -z $2 ];then
    docker run --rm -it \
            -e "COVERALLS_RUN_LOCALLY=1" \
            -e "COVERALLS_REPO_TOKEN="$COVERALLS_REPO_TOKEN \
            -v ${PJ_ROOT}:/release luiscoms/release \
            vendor/bin/coveralls -v
fi
