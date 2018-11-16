#!/bin/sh

#
# Command line runner for unit tests for composer projects
# (c) Del 2015 http://www.babel.com.au/
# No Rights Reserved
#

#
# Ensure that dependencies are installed (including codeception and phpunit)
#
if [ -f composer.lock ]; then
    /usr/local/bin/composer install
else
    /usr/local/bin/composer update
fi

vendor/bin/phpunit tests/RapidConnectGatewayCertificationTest.php