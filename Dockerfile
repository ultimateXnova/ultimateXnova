FROM php:8.2-fpm-alpine

# Instalar extensiones de PHP necesarias para el juego
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Instalar Nginx para servir la web
RUN apk add --no-cache nginx

# Copiar los archivos del juego al servidor web
COPY . /var/www/html/

# Configurar permisos para el instalador
RUN chown -R www-data:www-data /var/www/html/

# Configurar Nginx de forma interna rápida
RUN mkdir -p /run/nginx && \
    echo 'server { listen 80; root /var/www/html; index index.php index.html; location / { try_files $uri $uri/ /index.php?$query_string; } location ~ \.php$ { include fastcgi_params; fastcgi_pass 127.0.0.1:9000; fastcgi_index index.php; fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name; } }' > /etc/nginx/http.d/default.conf

# Exponer el puerto 80
EXPOSE 80

# Comando para encender PHP y Nginx al mismo tiempo
CMD ["sh", "-c", "php-fpm -D && nginx -g 'daemon off;'"]
