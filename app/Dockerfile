FROM php:apache

RUN sudo a2enmod rewrite && sudo service apache2 restart
 
# WORKDIR /var/www/html
COPY . /var/www/html
 
ENV PORT=80

EXPOSE ${PORT}
 
RUN sed -i 's/Listen 80/Listen ${PORT}/' /etc/apache2/ports.conf