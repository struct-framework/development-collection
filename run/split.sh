#!/usr/bin/env bash

##
## Contracts
##

git subtree split -P packages/contracts/operator    -b contracts-operator
git subtree split -P packages/contracts/struct      -b contracts-struct

git push contracts-operator   contracts-operator:2.0 -f
git push contracts-struct     contracts-struct:2.0 -f

git branch -D contracts-operator
git branch -D contracts-struct



##
## Implementation
##

git subtree split -P packages/implementation/data-type   -b implementation-data-type
git subtree split -P packages/implementation/operator    -b implementation-operator
git subtree split -P packages/implementation/reflection  -b implementation-reflection
git subtree split -P packages/implementation/struct      -b implementation-struct

git push implementation-data-type    implementation-data-type:2.0 -f
git push implementation-operator     implementation-operator:2.0 -f
git push implementation-reflection   implementation-reflectionr:2.0 -f
git push implementation-struct       implementation-struct:2.0 -f

git branch -D implementation-data-type
git branch -D implementation-operator
git branch -D implementation-reflection
git branch -D implementation-struct



