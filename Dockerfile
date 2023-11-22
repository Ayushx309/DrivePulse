# syntax=docker/dockerfile:1.4

FROM --platform=$BUILDPLATFORM php:8.2.12-apache as builder

LABEL maintainer="Kamlekar"

# Set working directory
WORKDIR /var/www/html

RUN docker-php-ext-install mysqli
CMD ["apache2-foreground"]

FROM builder as dev-envs

RUN apt-get update
RUN apt-get install -y --no-install-recommends git
RUN docker-php-ext-install mysqli

# OpenSSL for MSSQL Remote Connection Support
RUN apt-get install -y --no-install-recommends openssl \ 
    && sed -i 's,^\(MinProtocol[ ]*=\).*,\1'TLSv1.0',g' /etc/ssl/openssl.cnf \
    && sed -i 's,^\(CipherString[ ]*=\).*,\1'DEFAULT@SECLEVEL=1',g' /etc/ssl/openssl.cnf\
    && rm -rf /var/lib/apt/lists/*
RUN apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

# install Docker tools (cli, buildx, compose)
COPY --from=gloursdocker/docker / /

CMD ["apache2-foreground"]
