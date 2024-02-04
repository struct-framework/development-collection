#!/usr/bin/env bash

##
## Contracts
##

git subtree split -P packages/contracts/operator    -b contracts-operator
git subtree split -P packages/contracts/struct      -b contracts-struct

git push contracts-operator   contracts-operator:main -f
git push contracts-struct     contracts-struct:main -f

git branch -D contracts-operator
git branch -D contracts-struct



##
## Implementation
##

git subtree split -P packages/implementation/data-type   -b implementation-data-type
git subtree split -P packages/implementation/operator    -b implementation-operator
git subtree split -P packages/implementation/struct      -b implementation-struct

git push implementation-data-type    implementation-data-type:main -f
git push implementation-operator     implementation-operator:main -f
git push implementation-struct       implementation-struct:main -f

git branch -D implementation-operator
git branch -D implementation-struct
git branch -D implementation-data-type


