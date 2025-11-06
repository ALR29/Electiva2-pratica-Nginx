# Usamos la imagen oficial de PHP 8.2 con Apache
FROM php:8.2-apache

# Instalamos la extensión mysqli para que PHP pueda conectarse a MySQL
RUN docker-php-ext-install mysqli

# (Opcional) Habilitamos mod_rewrite para futuras URLs amigables
RUN a2enmod rewrite