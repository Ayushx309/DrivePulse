#!/bin/bash

# Define the prefix for container names, volume names, and image names
PREFIX="drivepulse"

# Get a list of container IDs that match the prefix
CONTAINER_IDS=$(docker ps -a --format "{{.ID}} {{.Names}}" | grep " $PREFIX" | awk '{print $1}')

# Remove the containers
for CONTAINER_ID in $CONTAINER_IDS; do
  docker rm -f $CONTAINER_ID
done

# Get a list of volume names that match the prefix
VOLUME_NAMES=$(docker volume ls --format "{{.Name}}" | grep "^$PREFIX")

# Remove the volumes
for VOLUME_NAME in $VOLUME_NAMES; do
  docker volume rm $VOLUME_NAME
done

# Get a list of image IDs that match the prefix
IMAGE_IDS=$(docker images --format "{{.ID}} {{.Repository}}" | grep " $PREFIX" | awk '{print $1}')

# Remove the images
for IMAGE_ID in $IMAGE_IDS; do
  docker rmi -f $IMAGE_ID
done

docker system prune --all --force
docker-compose up --build --force-recreate
