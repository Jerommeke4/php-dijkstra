#!/usr/bin/env bash

socat -d -d TCP-L:8099,fork UNIX:/var/run/docker.sock
sudo ifconfig en0 alias 10.254.254.254 255.255.255.0

docker-compose up
