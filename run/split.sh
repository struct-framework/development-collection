#!/usr/bin/env bash

git subtree split -P packages/struct              -b struct
git subtree split -P packages/struct-contracts    -b struct-contracts
git subtree split -P packages/data-type           -b data-type
git subtree split -P packages/data-type-contracts -b data-type-contracts


git push struct                 struct:main -f
git push struct-contracts       struct-contracts:main -f
git push data-type              data-type:main -f
git push data-type-contracts    data-type-contracts:main -f

git branch -D struct
git branch -D data-type
git branch -D data-type-contracts
