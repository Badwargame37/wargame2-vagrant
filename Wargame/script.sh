#!/bin/bash
# This script launches Docker Compose services at machine startup

# Start Docker Compose services
docker-compose -f ${HOME}/docker-stack/wargame-mexico/DockerCompose/network-config.yml up -d
docker-compose -f ${HOME}/docker-stack/haproxy/docker-compose.yml up -d
docker-compose -f ${HOME}/docker-stack/guacamole/docker-compose.yml up -d
docker-compose -f ${HOME}/docker-stack/wordpress/docker-compose.yml up -d
docker-compose -f ${HOME}/docker-stack/wargame-mexico/DockerCompose/Reverse/docker-compose.yml up -d
docker-compose -f ${HOME}/docker-stack/wargame-mexico/DockerCompose/pivot/docker-compose.yml up -d

# Perform some actions with the pivot Docker Compose service
docker-compose -f ${HOME}/docker-stack/wargame-mexico/DockerCompose/pivot/docker-compose.yml down
docker-compose -f ${HOME}/docker-stack/wargame-mexico/DockerCompose/pivot/docker-compose.yml up -d

# You may add more actions or services to start as needed
