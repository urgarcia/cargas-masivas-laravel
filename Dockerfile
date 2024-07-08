# Utilizamos una imagen base oficial de PHP con soporte para Apache
FROM php:8.1-apache

# Instalamos las dependencias necesarias
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl

# Instalamos Composer
COPY --from=composer:2.1 /usr/bin/composer /usr/bin/composer

# Establecemos el directorio de trabajo
WORKDIR /var/www

# Copiamos los archivos de la aplicación
COPY . .

# Instalamos las dependencias de PHP
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Habilitamos el módulo de reescritura de Apache y el módulo MPM Prefork
RUN a2enmod rewrite && a2enmod mpm_prefork

# Copiamos la configuración de Apache
COPY ./apache/apache2.conf /etc/apache2/apache2.conf

# Añadimos la directiva LoadModule para MPM Prefork
RUN echo "LoadModule mpm_prefork_module /usr/lib/apache2/modules/mod_mpm_prefork.so" >> /etc/apache2/apache2.conf


# Crear directorio de logs y asignar permisos
RUN mkdir -p /etc/apache2/logs/ \
    && chown -R www-data:www-data /etc/apache2/logs/

# Exponemos el puerto 80 para Apache
EXPOSE 80

# Iniciamos Apache
CMD ["apache2-foreground"]
