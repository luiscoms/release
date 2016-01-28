Release
==

[![Build Status](https://travis-ci.org/luiscoms/release.svg?branch=master)](https://travis-ci.org/luiscoms/release)

Lightweight library to update package version according [Semantic Versioning](http://semver.org/).
Aditionally can create git tag, commit and push

Installation
----

    composer require luiscoms/release dev-master

Usage
----

Let's consider the `composer.json` file

```json
{
    "version": "0.0.1",
    "require": {
        "luiscoms/release": "dev-master"
    }
}
```

To view current version

    vendor/bin/release
    0.0.1

To update patch

    vendor/bin/release --patch|--bugfix
    0.0.2

To update minor

    vendor/bin/release --minor|--feature
    0.1.0

To update major

    vendor/bin/release --major
    1.0.0
