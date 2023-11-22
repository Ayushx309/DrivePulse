# Use an official MySQL image as a base image
FROM mysql:latest as mysql-builder

# Copy the MySQL configuration file into the image
COPY mysql-config.env /mysql-config.env

# Source the configuration file to set environment variables
RUN /bin/bash -c "set -o allexport && source /mysql-config.env && set +o allexport"

# Copy SQL scripts into the /docker-entrypoint-initdb.d/ directory to be automatically executed when the container starts
COPY ./sql/tables/ /docker-entrypoint-initdb.d/
