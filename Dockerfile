FROM php:8.2-apache

COPY mm.conf /etc/apache2/apache2.conf

RUN a2enmod rewrite
RUN sudo service apache2 restart