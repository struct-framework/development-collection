#!/usr/bin/env bash

git subtree split -P packages/contracts/data-type   -b contracts-data-type
git subtree split -P packages/contracts/operator    -b contracts-operator
git subtree split -P packages/contracts/serialize   -b contracts-serialize
git subtree split -P packages/contracts/struct      -b contracts-struct

git subtree split -P packages/implementation/operator    -b implementation-operator
git subtree split -P packages/implementation/serializing -b implementation-serializing
git subtree split -P packages/implementation/struct      -b implementation-struct
git subtree split -P packages/implementation/data-type   -b implementation-data-type



git push contracts-data-type  contracts-data-type:main -f
git push contracts-operator   contracts-operator:main -f
git push contracts-serialize  contracts-serialize:main -f
git push contracts-struct     contracts-struct:main -f

git push implementation-operator     implementation-operator:main -f
git push implementation-serializing  implementation-serializing:main -f
git push implementation-struct       implementation-struct:main -f
git push implementation-data-type    implementation-data-type:main -f



git branch -D contracts-data-type
git branch -D contracts-operator
git branch -D contracts-serialize
git branch -D contracts-struct

git branch -D implementation-operator
git branch -D implementation-serializing
git branch -D implementation-struct
git branch -D implementation-data-type


