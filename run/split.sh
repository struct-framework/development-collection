#!/usr/bin/env bash

git subtree split -P packages/struct -b struct
git subtree split -P packages/struct-contracts -b struct-contracts

git push struct struct:main -f
git push struct-contracts struct-contracts:main -f

git branch -D struct
git branch -D struct-contracts