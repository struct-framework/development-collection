#!/usr/bin/env bash

git subtree split -P packages/contracts/data-type   -b contracts-data-type
git subtree split -P packages/contracts/operator    -b contracts-operator
git subtree split -P packages/contracts/serialize   -b contracts-serialize
git subtree split -P packages/contracts/struct      -b contracts-struct

git subtree split -P packages/implementation/data-type  -b data-type
git subtree split -P packages/implementation/operator   -b operator
git subtree split -P packages/implementation/serialize  -b serialize
git subtree split -P packages/implementation/struct     -b struct



git push contracts-data-type  contracts-data-type:main -f
git push contracts-operator   contracts-operator:main -f
git push contracts-serialize  contracts-serialize:main -f
git push contracts-struct     contracts-struct:main -f

git push data-type            data-type:main -f
git push operator             operator:main -f
git push serialize            serialize:main -f
git push struct               struct:main -f


git branch -D contracts-data-type
git branch -D contracts-operator
git branch -D contracts-serialize
git branch -D contracts-struct

git branch -D data-type
git branch -D operator
git branch -D serialize
git branch -D struct


