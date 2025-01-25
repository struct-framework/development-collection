#!/bin/bash

docker run --rm -ti -v ${PWD}:/opt/project \
   -w /opt/project \
   registry.z3.ag/z3/docker-images/p1450-development-images/php-xdebug-8-3:latest \
   bin/phpstan analyse -l max \
   -c development-configuration/phpstan.neon \
   packages/**/**/src* tests

   # packages/implementation/data-type/src*


