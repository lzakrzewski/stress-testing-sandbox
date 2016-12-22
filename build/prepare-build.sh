#!/usr/bin/env bash

rm test_key  2> /dev/null
rm test_key.pub  2> /dev/null
ssh-keygen -t rsa -b 4096 -C "test@test.com" -f test_key -N ''
cp build/test.config.makefile config/config.makefile