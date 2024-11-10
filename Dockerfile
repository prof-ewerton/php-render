FROM php:apache

RUN sudo a2enmod rewrite && sudo service apache2 restart
 
WORKDIR /var/www/html
COPY web .
 
ENV PORT=8080

EXPOSE ${PORT}
 
RUN sed -i 's/Listen 80/Listen ${PORT}/' /etc/apache2/ports.conf