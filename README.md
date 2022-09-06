# Recetas

Ejecutar los siguientes comandos para dev en local por primera vez

> docker-compose build app
> docker-compose up -d
> docker-compose exec app composer install
 
Después
> docker-compose up -d


## Nohup
> nohup /opt/plesk/php/7.4/bin/php artisan albaran:entradas > /dev/null 2 > &1 &
### List
> ps xw