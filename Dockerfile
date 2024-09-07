#FROM php:8.2-apache

#COPY mm.conf /etc/apache2/apache2.conf

#RUN a2enmod rewrite

FROM php:apache
 
WORKDIR /web
COPY web .
 
ENV PORT=8000
EXPOSE ${PORT}
 
RUN sed -i 's/Listen 80/Listen ${PORT}/' /etc/apache2/ports.conf