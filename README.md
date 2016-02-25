Release
==

[![Latest Stable Version](https://poser.pugx.org/luiscoms/release/v/stable)](https://packagist.org/packages/luiscoms/release) [![Latest Unstable Version](https://poser.pugx.org/luiscoms/release/v/unstable)](https://packagist.org/packages/luiscoms/release)
[![Build Status](https://travis-ci.org/luiscoms/release.svg?branch=master)](https://travis-ci.org/luiscoms/release) [![Coverage Status](https://coveralls.io/repos/github/luiscoms/release/badge.svg?branch=master)](https://coveralls.io/github/luiscoms/release) [![SensioLabsInsight](https://insight.sensiolabs.com/projects/8e7b3800-4f6a-45a0-a06f-be3dbf6e6f96/mini.png)](https://insight.sensiolabs.com/projects/8e7b3800-4f6a-45a0-a06f-be3dbf6e6f96)

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

    vendor/bin/release [current]
    0.0.1

To update patch

    vendor/bin/release bump --patch|--bugfix
    0.0.2

To update minor

    vendor/bin/release bump --minor|--feature
    0.1.0

To update major

    vendor/bin/release bump --major
    1.0.0
