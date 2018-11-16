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

# 247080010: PASS
# vendor/bin/phpunit --filter testCaseNumber000247080010 tests/FinalCertificationTest.php

# 528150011: FAIL, Parent not found
vendor/bin/phpunit --filter testCaseNumber000528150010And000528150011 tests/FinalCertificationTest.php
# 528160011: FAIL, Parent not found
vendor/bin/phpunit --filter testCaseNumber000528160010And000528160011 tests/FinalCertificationTest.php
# 528950011: FAIL, Parent not found
vendor/bin/phpunit --filter testCaseNumber000528950010And000528950011 tests/FinalCertificationTest.php

# 136870010: PASS when POS Condition Code is 00, _NOT_ when using expected/suggested 71
# vendor/bin/phpunit --filter testCaseNumber000136870010 tests/FinalCertificationTest.php

# 142620010: INCMP, Test case not found, included in list I downloaded yesterday
# vendor/bin/phpunit --filter testCaseNumber000142620010 tests/FinalCertificationTest.php

# 22420020: PASS
# 22420021: FAIL, Parent not found
vendor/bin/phpunit --filter testCaseNumber000022420020And000022420021 tests/FinalCertificationTest.php

# 23230020: PASS
# vendor/bin/phpunit --filter testCaseNumber000023230020 tests/FinalCertificationTest.php

# 24130020: INCMP, Test case not found
# 24130021: FAIL, Parent not found
# vendor/bin/phpunit --filter testCaseNumber000024130020And000024130021 tests/FinalCertificationTest.php




#vendor/bin/phpunit --filter testCaseNumber000022420020And000022420021 tests/RapidConnectGatewayCertificationTest.php
#vendor/bin/phpunit --filter testCaseNumber000003270010 tests/RapidConnectGatewayCertificationTest.php
#vendor/bin/phpunit --filter testCaseNumber000003310010 tests/RapidConnectGatewayCertificationTest.php
#vendor/bin/phpunit --filter testCaseNumber000003250010 tests/RapidConnectGatewayCertificationTest.php
#vendor/bin/phpunit --filter testCaseNumber000003350010 tests/RapidConnectGatewayCertificationTest.php
#vendor/bin/phpunit --filter testCaseNumber000003330010 tests/RapidConnectGatewayCertificationTest.php
#vendor/bin/phpunit --filter testCaseNumber000003290010 tests/RapidConnectGatewayCertificationTest.php
#vendor/bin/phpunit --filter testCaseNumber000024230010 tests/RapidConnectGatewayCertificationTest.php
#
#
#vendor/bin/phpunit --filter testCaseNumber000133760010 tests/RapidConnectGatewayCertificationTest.php
#vendor/bin/phpunit --filter testCaseNumber000022440011 tests/RapidConnectGatewayCertificationTest.php
#vendor/bin/phpunit --filter testCaseNumber000235520011 tests/RapidConnectGatewayCertificationTest.php
#
#vendor/bin/phpunit --filter testCaseNumber000180140011 tests/RapidConnectGatewayCertificationTest.php
#vendor/bin/phpunit --filter testCaseNumber000180270011 tests/RapidConnectGatewayCertificationTest.php
#vendor/bin/phpunit --filter testCaseNumber000247130011 tests/RapidConnectGatewayCertificationTest.php