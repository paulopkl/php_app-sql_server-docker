FROM php:8.2-apache

USER root

# Defines Workdir
WORKDIR /var/www/html

HEALTHCHECK CMD curl --fail http://localhost/index.php || exit 1

# Install libs
RUN apt-get update && apt-get install -y gnupg2 curl

# Download official microsoft keys and add to keys repository
RUN curl https://packages.microsoft.com/keys/microsoft.asc | apt-key add -

# Adding repository configuration files for package managers in Linux systems
RUN curl https://packages.microsoft.com/config/debian/11/prod.list > /etc/apt/sources.list.d/mssql-release.list 

ENV ACCEPT_EULA=Y

# Install libs for PHP
RUN apt-get update && \
    apt-get install -y msodbcsql17 odbcinst=2.3.7 odbcinst1debian2=2.3.7 unixodbc-dev=2.3.7 unixodbc=2.3.7

# Install driver of SQL Server for PHP
RUN pecl install sqlsrv pdo_sqlsrv && \
    docker-php-ext-enable sqlsrv pdo_sqlsrv

# /var/www/html
COPY app/src/ .

RUN useradd -m php
USER php

EXPOSE 80

# CMD ["start-apache"]
