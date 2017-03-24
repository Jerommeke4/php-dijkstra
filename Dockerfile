FROM php:7.1.2-apache
# Install packages
COPY provision.sh ./provision.sh

RUN bash ./provision.sh
