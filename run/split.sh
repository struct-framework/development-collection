#!/usr/bin/env bash

git subtree split -P packages/contracts   -b contracts
git subtree split -P packages/data-type   -b data-type
git subtree split -P packages/serializer  -b serializer
git subtree split -P packages/struct      -b struct



git push contracts   contracts:main -f
git push data-type   data-type:main -f
git push serializer  serializer:main -f
git push struct      struct:main -f


git branch -D contracts
git branch -D data-type
git branch -D serializer
git branch -D struct


